<div data-role="content">
	<ul data-role="listview" data-theme="c" data-dividertheme="b">

		<?php

		// Let's loop over every chapter. The array is just $chapters because we used get_iterated(), else it would be $chapters->all
		foreach ($chapters as $key => $chapter) {
			echo '<li>' . $chapter->url() . '</li>';
		}
		?>
	</ul>
</div><!-- /content -->