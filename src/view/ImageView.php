<?php

namespace view;

class ImageView {

	private $imageModel;

	public function __construct(\model\ImageModel $imageModel) {

		$this->imageModel = $imageModel;

	}

	public function showAllImagesHTML(array $dbImages) {

		$html = "
		 	<div class='container'>
		 		<div id='content'>
		 			<h2>Add pictures to your destination</h2>
			 		<div id='contentwrapper'>";

/*		if($this->getMessage() !== null) {

			$html .= "<div class=Msgstatus>$this->message</div>";
		}; */

		$html .= "
			<p><a href='#'>Return to map</a></p>
			<form enctype='multipart/form-data' method='post' action='?uploadpage'>
			 	<input type='submit' name='submit' id='uploadPageButton' value='Add picture' />
			</form>";

		foreach ($dbImages as $date => $images) {
		
			foreach ($images as $image) {

				$imageURL = $image["image"];

				$html .= "
					<div class='image'>
						<a title='tripShotsMapper' href='./images/$imageURL'>
						<img src='./images/$imageURL' alt='img'/></a>
						<table id='buttontable'>
							<tr>
								<td>
									<form action='?delete' enctype='multipart/form-data' method='post'>
										<input type='hidden' value='$imageURL' name='delete_file'>
						 				<input type='submit' name='submit' id='deleteButton' value='Delete picture'>
						 			</form>
					 			</td>					 			
					 		</tr>
			 			</table>
					</div>";

			}
		}

		$html .= "
							</div>
						</div>
					</div>
				";

		return $html;
	}
}