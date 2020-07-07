<?php
echo('
<div class="w3-row w3-padding alt2-align-cm">
	<div class="w3-col m12">
		<div class="w3-row">
			<picture class="category-banner">
				<source srcset="/magazine/images/category_banners/'. $category_query .'.webp" type="image/webp">
				<img width="100%" src="/magazine/images/category_banners/'. $category_query .'.png" alt="">
			</picture>
		</div>
	</div>
</div>
');
?>