<html>

<head>
<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet"> <!-- tailwind https://tailwindcss.com/docs-->

</head>

<?php 
 $environment = getenv('environment');
 $job_post_link = $environment == 'development' ? getenv('dev_job_post_link') : getenv('prod_job_post_link');
 $charge_customer_link = $environment == 'development' ? getenv('dev_charge_customer_link') : getenv('prod_charge_customer_link');
 $api_username = $environment == 'development' ? getenv('dev_api_username') : getenv('prod_api_username');
 $api_key = $environment == 'development' ? getenv('dev_api_key') : getenv('prod_api_key');
 $samplePayload = array(
    'job_title' => 'Payruler test job', 
    'job_description' => 'Sample description', 
    'job_type' => 'Part-time',
    'level' => 'Supervisor / 3 years and up experience', 
    'maximum_salary' => 100000, 
    'minimum_salary' => 70000, 
    'province_id' => [
      'label'=> 'Cebu',
      'value'=> 24
    ], 
    'total' => 5000, 
    'referral_count' => 5, 
    'referral_fee' => 2000, 
    'job_category' => [
      'label'=> 'IT Outsourcing',
      'value'=> 82
    ], 
    'industry' => [
      'label'=> 'BPO',
      'value'=> 16
    ], 
    'employer_id' => 4505, 
    'minimum_qualification' => 'Bachelors Degree', 
    'minimum_experience' => '1 to 2 years', 
    'home_based' => [
      'label'=> 'Yes',
      'value'=> true
    ], 
    'traits' => '[{"trait":"Extrovert / Outwardly-Focused"},{"trait":"Attention to Detail"}]', 
    'skills' => '[{"skill_name":"test","skill_description":"test"}]',
    'vat' => 75,
    'fee' => 200,
    'status' => 'Active',
    'visible' => 'true'
 );

?>

<div class="flex flex-col items-center">
  <p class="text-2xl font-bold flex">Pasajob CRM Job posting template (PHP language)</p>
  <p> The fields below are the required fields needed in order to post a job to PasaJob</p>
</div>

<div class="flex h-auto w-full justify-center">
  <div class="flex flex-wrap w-3/5 justify-center flex-row">
    <?php 
      foreach($samplePayload as $key => $sample) {
         $label = is_array($sample) && array_key_exists('label',$sample) ? $sample['label'] : $sample;
         echo "<div class='flex flex-col mt-5'>".$key."<input class='h-10 border px-3 mr-5 mb-2 border-gray-400 rounded' placeholder='Job title' type='text' name='Job title' value='".$label."'/></div>";
      }
    ?>
  </div>
</div>

<div class="flex justify-center">
  <button onclick="chargeCustomer()"class="bg-blue-400 text-white h-10 w-20 rounded hover:bg-green-400">POST JOB</button>
</div>

<script type="text/javascript">

function chargeCustomer() {
  var myHeaders = new Headers();
  myHeaders.append("Content-Type", "application/x-www-form-urlencoded");

  var urlencoded = new URLSearchParams();
  urlencoded.append('name','Sample user name');
  urlencoded.append('number','Sample Card number');
  urlencoded.append('exp_month','Sample exp month');
  urlencoded.append('exp_year','Sample exp year');
  urlencoded.append('cvc','Sample CVC');
  urlencoded.append('api_username','<?php echo $api_username;?>');
  urlencoded.append('api_key','<?php echo $api_key;?>');
  var requestOptions = {
    method: 'POST',
    headers: myHeaders,
    body: urlencoded,
    redirect: 'follow'
  };
  
  fetch('<?php echo $charge_customer_link;?>', requestOptions)
   .then(response => response.json())
   .then(result => postJob(result.transaction_id))
   .catch(error => console.log('error', error));
}

function postJob(transaction_id) {
  var myHeaders = new Headers();
  myHeaders.append("Content-Type", "application/x-www-form-urlencoded");

  var urlencoded = new URLSearchParams();
  <?php
    foreach($samplePayload as $key => $sample) {
      $value = is_array($sample) && array_key_exists('label',$sample) ? $sample['value'] : $sample;
      echo "urlencoded.append('".$key."','".$value."');";
    }

  ?>
    urlencoded.append("transaction_id",transaction_id);
    urlencoded.append("api_username",'<?php echo $api_username;?>');
    urlencoded.append("api_key",'<?php echo $api_key;?>');
    var requestOptions = {
      method: 'POST',
      headers: myHeaders,
      body: urlencoded,
      redirect: 'follow'
    };
    
    fetch('<?php echo $job_post_link;?>', requestOptions)
      .then(response => response.text())
      .then(result => alert(result))
      .catch(error => console.log('error', error));
    
}
</script> 
</html>
