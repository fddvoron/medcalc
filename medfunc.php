<? 

function Clearance_KG($sextype, $massa, $age, $creatinine){

  if ($sextype == 1) $sex = 1.23;
  if ($sextype == 2) $sex = 1.04;

  $clearance = ($sex * $massa * (140 - $age)) / $creatinine;
  $result = round($clearance, 2);
  return $result;
}

function Clearance_EPI($sextype, $age, $creatinine){

	if ($sextype == 1) 
	{
	$alpha = -0.411;
	$kappa = 0.9;
	$sexepi = 1;
	}

  if ($sextype == 2)
  {
  $alpha = -0.329;
  $kappa = 0.7;
  $sexepi = 1.018;
  }

	$creatinine = ($creatinine * 0.0113)/$kappa;
	$crmin = min($creatinine, 1);
	$crmax = max($creatinine, 1);
	$clearanceepi = 141 * pow($crmin, $alpha) * pow($crmax, -1.209) * pow(0.993, $age) * $sexepi;
	$result = round($clearanceepi, 2);

  return $result;
}

function IMT($height, $massa){

	$height = $height / 100;
	$imt = $massa / ($height * $height);
	$result = round($imt, 2);

  return $result;

}

?>