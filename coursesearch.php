


<p class="container" id="course_size"></p>
<div id="courses_container"></div>
<script type="text/javascript">
	var search_url = '<?php echo home_url(); ?>/api/v1/';
</script>
<script id="courses_template" type="x-underscore">
	<?php echo file_get_contents(dirname(__FILE__) . '/templates/courses.underscore'); ?>
</script>
