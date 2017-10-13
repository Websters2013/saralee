<?php
/**
 * Class that manages all the features of Five Star Rating Wordpress plugin
 *
 */
class FSR {
	var $_points = 0;
	var $_user;
	var $_momentLimit = 10;

	/**
	 * Create the database tables to support plugin behaviour.
	 *
	 * @param boolean $echo If true echoes messages to user
	 */
	function install($echo = false) {
		global $table_prefix, $wpdb;

		$table_name = $table_prefix . "fsr_post";
		if ($wpdb->get_var("SHOW TABLES LIKE '{$table_name}'") !== $table_name) {
			$sql = "CREATE TABLE {$table_name} (
			  ID bigint(20) unsigned NOT NULL default '0',
			  votes int(10) unsigned NOT NULL default '0',
			  points int(10) unsigned NOT NULL default '0',
			  PRIMARY KEY (ID)
			);";

			require_once(ABSPATH . 'wp-admin/upgrade-functions.php');
			dbDelta($sql);
			if ($echo) _e("Table has been created\n", 'five-star-rating');
		} else {
			if ($echo) _e("The table has already been created\n", 'five-star-rating');
		}

		$table_name = $table_prefix . "fsr_user";
		if ($wpdb->get_var("SHOW TABLES LIKE '{$table_name}'") !== $table_name) {
			$sql = "CREATE TABLE {$table_name} (
			  user varchar(32) NOT NULL default '',
			  post bigint(20) unsigned NOT NULL default '0',
			  points int(10) unsigned NOT NULL default '0',
			  ip char(15) NOT NULL,
			  vote_date datetime NOT NULL,
			  PRIMARY KEY (`user`,post),
			  KEY vote_date (vote_date)
  		);";
			require_once(ABSPATH . 'wp-admin/upgrade-functions.php');
			dbDelta($sql);
			if ($echo) _e("Scorecard created\n", 'five-star-rating');
		} elseif (!$wpdb->get_row("SHOW COLUMNS FROM {$table_name} LIKE 'vote_date'")) {
			$wpdb->query("ALTER TABLE {$table_name} ADD ip CHAR( 15 ) NOT NULL, ADD vote_date DATETIME NOT NULL");
			$wpdb->query("ALTER TABLE {$table_name} ADD INDEX (vote_date)");
			if ($echo) _e("Scorecard has been updated\n", 'five-star-rating');
		} else {
			if ($echo) _e("The scorecard was already created\n", 'five-star-rating');
		}
	}

	/**
	 * Get the html that shows the stars for voting
	 * If the user has already vote then it shows stars with puntuation. No voting is allowed
	 *
	 * @return string
	 */
	function getVotingStars($starType) {
		global $id, $wpdb, $table_prefix;
		$rated = false;
		if (isset($this->_user)) {
			$user = $wpdb->escape($this->_user);
			$table_name = $table_prefix . "fsr_user";
			$rated = (bool) $wpdb->get_var("SELECT COUNT(*) FROM {$table_name} WHERE user='{$user}' AND post={$id}");
		}
		if (($this->_points > 0) && !$rated) {
			$user = $wpdb->escape($this->_user);
			$table_name = $table_prefix . "fsr_user";
			$ip = $_SERVER['REMOTE_ADDR'];
			$vote_date = date('Y-m-d H:i:s');
			$wpdb->query("INSERT INTO {$table_name} (user, post, points, ip, vote_date) VALUES ('{$user}', {$id}, {$this->_points}, '{$ip}', '{$vote_date}')");
			$table_name = $table_prefix . "fsr_post";
			if ($wpdb->get_var("SELECT COUNT(*) FROM {$table_name} WHERE ID={$id}")) {
				$wpdb->query("UPDATE {$table_name} SET votes=votes+1, points=points+{$this->_points} WHERE ID={$id};");
			} else {
				$wpdb->query("INSERT INTO {$table_name} (ID, votes, points) VALUES ({$id}, 1, {$this->_points});");
			}
			$rated = true;
//			$this->_setBestsOfMoment();
		}
		$data = $this->_getPoints();
		if ($rated || !isset($_COOKIE['wp_fsr'])) {
			$html = $this->_drawStars($data->votes, $data->points,$starType);
		} else {
			$html = $this->_drawVotingStars($data->votes, $data->points,$starType);
		}
		return $html;
	}

	/**
	 * Get the html that shows the stars with puntuation.
	 *
	 * @return string
	 */
	function getStars($starType) {
		$data = $this->_getPoints();
		return $this->_drawStars($data->votes, $data->points,$starType);
	}

	/**
	 * Get the points and votes of current post
	 *
	 * @return object
	 */
	function _getPoints() {
		global $id, $wpdb, $table_prefix;
		$table_name = $table_prefix . "fsr_post";
		return $wpdb->get_row("SELECT votes, points FROM {$table_name} WHERE ID={$id}");
	}
	
	/**
	 * Draw the stars
	 *
	 * @param int $votes
	 * @param int $points
	 * @return string
	 */
	function _drawStars($votes, $points, $starType) {
		if ($votes > 0) {
			$rate = $points / $votes;
		} else {
			$rate = 0;
		}
		$html = '<div class="FSR_container"  data-rate="'.$rate.'"><div class="FSR_stars">';
		for ($i = 1; $i <= 5; ++$i) {
			if ($i <= $rate) {
				$class = 'FSR_full_' . $starType;
				$char = '*';
			} elseif ($i <= ($rate + .5)) {
				$class = 'FSR_half_' . $starType;
				$char = '&frac12;';
			} else {
				$class = 'FSR_no_' . $starType;
				$char = '&nbsp;';
			}
			$html .= '<span class="' . $class . '">' . $char . '</span> ';
		}
		//$html .= '<span class="FSR_votes">' . (int) $votes . '</span> ';
		//$html .= _n('<span class="FSR_tvotes">rating</span>', '<span class="FSR_tvotes">ratings'.$rate.'</span>', $votes, 'five-star-rating');
		$html .= '</div></div>';
		return $html;
	}

	/**
	 * Draw the voting stars
	 *
	 * @param int $votes
	 * @param int $points
	 * @return string
	 */
	function _drawVotingStars($votes, $points, $type) {
		global $id;
		if ($votes > 0) {
			$rate = $points / $votes;
		} else {
			$rate = 0;
		}
		$html = '<div class="FSR_container"  data-rate="'.$rate.'"><form id="FSR_form_' . $id . '" action="' . WP_PLUGIN_URL . '/five-star-rating/fsr-ajax-stars.php" method="post" class="FSR_stars" onmouseout="FSR_star_out(this)"> ';
		for ($i = 1; $i <= 5; ++$i) {
			if ($i <= $rate) {
				$class = 'FSR_full_voting_' . $type;
				$char = '*';
			} elseif ($i <= ($rate + .5)) {
				$class = 'FSR_half_voting_' . $type;
				$char = '&frac12;';
			} else {
				$class = 'FSR_no_voting_' . $type;
				$char = '&nbsp;';
			}
			//$html .= sprintf('<input type="radio" id="fsr_star_%1$d_%2$d" class="star" name="fsr_stars" value="%2$d"/><label class="%3$s" for="fsr_star_%1$d_%2$d" onmouseover="FSR_star_over(this, %2$d)">%2$d</label> ', $id, $i, $class);
			$html .= sprintf('<input type="radio" id="fsr_star_%1$d_%2$d" class="star" name="fsr_stars" value="%2$d"/><label class="%3$s" for="fsr_star_%1$d_%2$d">%2$d</label> ', $id, $i, $class);
		}
		//$html .= '<span class="FSR_votes">' . (int) $votes . '</span> ';
		//$html .= _n('<span class="FSR_tvotes">rating</span>','<span class="FSR_tvotes">ratings </span>',$votes, 'five-star-rating');
		//$html .=  '<span class="FSR_tvote FSR_important"> ' . __('Rate this dessert now!', 'five-star-rating') . '</span>';
		$html .= '<input type="hidden" name="p" value="' . $id . '" />';
		$html .= '<input type="hidden" name="starType" value="' . $type . '" />';
		$html .= '<input type="submit" name="vote" value="' . __('Voting', 'five-star-rating') . '" />';
		$html .= '</form>';
		$html .= '</div>';
		return $html;
	}

	function getBestOfMonth($star_type = 'star') {
		global $wpdb, $table_prefix;
		$month = date('m');
		$limit = 10;
		$table_name = $table_prefix . "fsr_user";
		$sql = "SELECT post, COUNT(*) AS votes, SUM(points) AS points, AVG(points)
			FROM {$table_name}
			WHERE MONTH(vote_date)={$month} AND YEAR(vote_date)=YEAR(NOW())
			GROUP BY 1
			ORDER BY 4 DESC, 2 DESC
			LIMIT {$limit}";
		$data = $wpdb->get_results($sql);
		if (is_array($data)) {
			$html = '<ul class="FSR_month_scores">';
			foreach ($data AS $row) {
				$title = get_the_title($row->post);
				$html .= '<li><a class="post_title" href="' . get_permalink($row->post) . '" title="' . $title . '">' . $title . '</a> ' . $this->_drawStars($row->votes, $row->points,$star_type) . '</li>';
			}
			$html .= '</ul>';
			return $html;
		}
	}
	
	function getAllTimeBest($star_type = 'star') {
		global $wpdb, $table_prefix;
		#$month = date('m');
		$limit = 10;
		$table_name = $table_prefix . "fsr_user";
		$sql = "SELECT post, COUNT(*) AS votes, SUM(points) AS points, AVG(points)
			FROM {$table_name}
			GROUP BY 1
			ORDER BY 4 DESC, 2 DESC
			LIMIT {$limit}";
		$data = $wpdb->get_results($sql);
		if (is_array($data)) {
			$html = '<ul class="FSR_alltime_scores">';
			foreach ($data AS $row) {
				$title = get_the_title($row->post);
				$html .= '<li><a class="post_title" href="' . get_permalink($row->post) . '" title="' . $title . '">' . $title . '</a> ' . $this->_drawStars($row->votes, $row->points,$star_type) . '</li>';
			}
			$html .= '</ul>';
			return $html;
		}
	}

	/**
	 * Initialize the values.
	 * Get the puntuation from url and the user from the cookies.
	 * If no cookie exists generate a new user.
	 * Refresh the cookie to hold the value of user for 1 year
	 *
	 */
	function init() {
		if (isset($_COOKIE['wp_fsr'])) {
			$this->_user = $_COOKIE['wp_fsr'];
		} 
		else {
		  if (!isset($this->_user)) {
		    srand((double)microtime()*1234567);
  			$this->_user = md5(microtime() . rand(1000, 90000000));
		  }
		}
		$cookieTime = time()*60;
		$cookie_expiration = get_option('fsr_cookie_expiration');
		$cookie_expiration_unit = get_option('fsr_cookie_expiration_unit');
		switch ($cookie_expiration_unit) {
		    case 'minute':
		        $cookieTime = time()+60*$cookie_expiration;
		        break;
		    case 'hour':
		        $cookieTime = time()+60*60*$cookie_expiration;
		        break;
		    case 'day':
		        $cookieTime = time()+60*60*24*$cookie_expiration;
		        break;
		}
		setcookie('wp_fsr', $this->_user, $cookieTime, '/');
		if (isset($_REQUEST['fsr_stars'])) {
			$points = (int) $_REQUEST['fsr_stars'];
			if (($points > 0) && ($points <= 5)) {
				$this->_points = $points;
			}
		}
	}
}
?>