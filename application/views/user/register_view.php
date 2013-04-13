<form>
	Имена:
	<input type="text" name="names" value="<?php echo $me['name']; ?>" /> <br />

	Факултетен номер:
	<input type="text" name="fn" value="" /> <br />

	Курс:
	<select name="course_year">
		<option value="B1">Първи курс Бакалавър</option>
		<option value="B2">Втори курс Бакалавър</option>
		<option value="B3">Трети курс Бакалавър</option>
		<option value="B4">Четвърти курс Бакалавър</option>
		<option value="M1">Първи курс Магистър</option>
		<option value="M2">Втори курс Магистър</option>
	</select> <br />

	Специалност:
	<select name="specialty">
		<?php foreach($specialties as $specialty): ?>
		<option value=""></option>
		<?php endforeach; ?>
	</select> <br />

	
</form>
