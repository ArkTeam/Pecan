 <?php
	class InspirationAction extends Controller {
		protected $inpiration;
		
		function listInspirations() {
			$this->inpiration = new ArkInspiration ();
			$inpirations = $this->inpiration->getInspirations ( 0, 5 );
		}
		
		function addAnInspiration($category_id, $inspiration_content) {
			$this->inpiration = new ArkInspiration ();
			if ($this->inpiration->createInspiration ( $category_id, $inspiration_content ) == 1) {
				echo 'success';
			}
		}
	}
	
	?>