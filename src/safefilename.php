<?php
	//https://fasforward.com/list-of-european-special-characters/

	namespace safeFilename;
 
	class safeFilename 
	{
		private $arrAccented = array();
		private $originalName = "";
		private $doubleScharfesS = false;
		private $replaceSpace = true;

		public function setDoubleScharfesS($bState=true)
		{
			$this->doubleScharfesS = $bState;
			$this->initArray();			
		}

		public function getDoubleScharfesS()
		{
			return $this->doubleScharfesS;
		}

		public function setOriginalName($originalName)
		{

			$this->originalName = $originalName;
		}

		public function getOriginalName()
		{	
			return $this->originalName;
		}

		public function setReplaceSpace($bState=true)
		{
			$this->replaceSpace = $bState;
		}

		public function getReplaceSpace()
		{
			return $this->replaceSpace;
		}

		public function __construct($originalName = "")
		{
			if ($originalName != "")
				$this->setOriginalName($originalName);
			$this->initArray();
		}		

		private function mb_str_replace($search, $replace, $subject)
		{
			$search = preg_quote($search);
			$exploded = mb_split($search, $subject);
			$result = implode($replace, $exploded);
			return $result;
		}

		private function initArray()
		{
			if ($this->doubleScharfesS)
			{
				$arrAccented["ss"] = ["ß"];				
				$arrAccented["SS"] = ["ẞ"];
				$arrAccented["s"] = ["ś","ŝ","ş","š","ș"];
				$arrAccented["S"] = ["Ś","Ŝ","Ş","Š","Ș"];		
			}
			else
			{
				$arrAccented["s"] = ["ś","ŝ","ş","š","ș","ß"];
				$arrAccented["S"] = ["Ś","Ŝ","Ş","Š","Ș","ẞ"];
			}
			$arrAccented["a"] = ["ä","à","á","â","ã","å","ǎ","ą","ă","æ","ā"];
			$arrAccented["A"] = ["Ä","À","Á","Â","Ã","Å","Ǎ","Ą","Ă","Æ","Ā"];
			$arrAccented["c"] = ["ç","ć","ĉ","č"];
			$arrAccented["C"] = ["Ç","Ć","Ĉ","Č"];
			$arrAccented["d"] = ["ď","ð"];
			$arrAccented["D"] = ["Ď","Đ"];
			$arrAccented["e"] = ["è","é","ê","ë","ě","ę","ė","ē"];
			$arrAccented["E"] = ["È","É","Ê","Ë","Ě","Ę","Ė","Ē"];
			$arrAccented["g"] = ["ĝ","ģ","ğ"];
			$arrAccented["G"] = ["Ĝ","Ģ","Ğ"];
			$arrAccented["h"] = ["ĥ"];
			$arrAccented["H"] = ["Ĥ"];
			$arrAccented["i"] = ["ì","í","î","ï","ı","ī","į"];
			$arrAccented["I"] = ["Ì","Í","Î","Ï","Ī","Į"];
			$arrAccented["j"] = ["ĵ"];
			$arrAccented["J"] = ["Ĵ"];
			$arrAccented["k"] = ["ķ"];
			$arrAccented["K"] = ["Ķ"];
			$arrAccented["l"] = ["ĺ","ļ","ł","ľ"];
			$arrAccented["L"] = ["Ĺ","Ļ","Ł","Ľ"];
			$arrAccented["n"] = ["ñ","ń","ň","ņ"];
			$arrAccented["N"] = ["Ñ","Ń","Ň","Ņ"];
			$arrAccented["o"] = ["ö","ò","ó","ô","õ","ő","ø","œ"];
			$arrAccented["O"] = ["Ö","Ò","Ó","Ô","Õ","Ő","Ø","Œ"];
			$arrAccented["r"] = ["ŕ","ř"];
			$arrAccented["R"] = ["Ŕ","Ř"];
			$arrAccented["t"] = ["ť","ţ","þ","ț"];
			$arrAccented["T"] = ["Ť","Ţ","Þ","Ț"];
			$arrAccented["u"] = ["ü","ù","ú","û","ű","ũ","ų","ů","ū"];
			$arrAccented["U"] = ["Ü","Ù","Ú","Û","Ű","Ũ","Ų","Ů","Ū"];
			$arrAccented["w"] = ["ŵ"];
			$arrAccented["W"] = ["Ŵ"];
			$arrAccented["y"] = ["ý","ÿ","ŷ"];
			$arrAccented["Y"] = ["Ý","Ÿ","Ŷ"];
			$arrAccented["z"] = ["ź","ž","ż"];
			$arrAccented["Z"] = ["Ź","Ž","Ż"];
			$this->arrAccented = $arrAccented;
		}

		public function result()
		{
			$result = $this->originalName;
			foreach ($this->arrAccented as $key => $accents) 
			{
				foreach ($accents as $value)
				{
					$result = $this->mb_str_replace($value,$key,$result);
				}
			}
			if ($this->replaceSpace)
			{
				$result = $this->mb_str_replace(" ","_",$result);
			}
			return $result;
		}

	}
?>