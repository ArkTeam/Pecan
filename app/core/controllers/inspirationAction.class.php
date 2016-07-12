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
		function addAnInspiration($category_id, $inspiration_content)
        {
            $this->inpiration = new ArkInspiration ();
            if ($inspiration_content == null) {
                $this->tpl_x->assign('tips', '内容不能为空');
                return false;
            }
            if ($this->inpiration->createInspiration($category_id, $inspiration_content) == 1) {
                echo 'success';
            }
        }

        function viewInspirations($pages=1) {
            $this->setPage($pages);
            if (! isset ( $s ) || ! isset ( $o )) {
                $s = $_SESSION ['s'];
                $o = $_SESSION ['o'];
                if (! $s) {
                    $s = 0;
                    $_SESSION ['s'] = $s;
                }
                if (! $o) {
                    $o = 10;
                    $_SESSION ['o'] = $o;
                }
                // echo 'S:'.$s.'<br/>O:'.$o.'<br/>';
            }
            $this->inpiration = new ArkInspiration ();
            $inspirations = $this->inpiration->getInspirations ( $s, $o );
            $this->tpl_x->assign( 'porpath', $_SESSION['porpath']);
            $this->tpl_x->assign ( 'username', $_SESSION ['username'] );
            $this->tpl_x->assign ( 'inspirations', $inspirations );
            $this->display ( 'listinspriations.tpl' );
        }
        function setPage ( $pages = 1 ,$rows=ROWS){
            if (!$this->inpiration){
                $this->inpiration = new ArkInspiration ();
            }
            $start = $rows * $pages - $rows;
            $_SESSION ['s'] = $start;
            $end = $rows;
            $_SESSION ['o'] = $end;
            $this->tpl_x->assign ( 'pages', $pages );
            $arr = $this->inpiration->getCounts ();
            $counts = array ();
            if($arr % $rows == 0){
                $eachpage=$arr / $rows;
            }else{
                $eachpage=$arr / $rows + 1;
            }
            for($i = 1; $i < $eachpage; $i ++) {
                array_push ( $counts, $i );
            }
            //next page & pre page
            $total_inpiration =  $this->inpiration->getCounts ();
            if($pages!=1){
                $this->tpl_x->assign( 'is_prev', true );
            }else{
                $this->tpl_x->assign( 'is_prev', false );
            }

            if($pages<(int)(($total_inpiration +ROWS-1)/ROWS)){
                $this->tpl_x->assign( 'is_next',  true);
            }else{
                $this->tpl_x->assign( 'is_next',  false);
            }
            $this->tpl_x->assign( 'porpath',  $_SESSION['porpath']);
            $this->tpl_x->assign ( 'counts', $counts );
        }
	}

	
	?>