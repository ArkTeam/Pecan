 <?php
	class InspirationAction extends Controller {
		protected $inpiration;
		function listInspirations($s, $o) {
			if(!isset($s)||!isset($o)){
				$s=0;
				$o=8;
			}
			$this->inpiration = new ArkInspiration ();
			$inspirations = $this->inpiration->getInspirations ( $s, $o );
			$this->tpl_x->assign ( 'inspirations', $inspirations );
			$this->display ( 'inspirations.html' );
		}
		function addAnInspiration($category_id, $inspiration_content) {
			$this->inpiration = new ArkInspiration ();
			if ($this->inpiration->createInspiration ( $category_id, $inspiration_content ) == 1) {
				echo 'success';
			}
		}
	}
	
	?>