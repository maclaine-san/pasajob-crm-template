# PasaJob CRM Job Posting template (using PHP)

This is an official template for CRM platforms to integrate their jobs and post it in PasaJob.


##  Official PasaJob Platforms 

    [SEEKER](https://seeker.pasajob.com)

    [EMPLOYER](https://employer.pasajob.com)

## How to run locally

### Using Docker

    0. docker-compose up -d 
    1. copy .env-example and create a .env file.
    2. test by going to http://localhost
    
## Executing Job Posting

	Steps in posting a job:
    0. Charge Customer -> get response id and inject as transaction_id in job post payload
    1. Job Post with Job post payload and transaction_id

### Charging Customer
	0. POST METHOD to these ENVIRONMENTS
		- dev environment: https://share.dev.pasajob.com/charge-customer
		- prod environment: https://share.pasajob.com/charge-customer
```
1. Payload list. Fields with ! are required.
{ 
	name: String!
	number: String!
	exp_month: Int!
	exp_year: Int!
	cvc: String!
	amount: Float!
    api_username: String!
    api_key: String!
} 
```
    
### Job Post Payload

	0. POST METHOD to these ENVIRONMENTS
		- dev environment: https://share.dev.pasajob.com/create-job-web
		- prod environment: https://share.pasajob.com/create-job-web
```
1. Payload list. Fields with ! are required.
{
  job_title: String!
  job_description: String!
  job_type: String!
  level: String!
  maximum_salary: Float!
  minimum_salary: Float!
  province_id: Int // obtain id from fields data
  total: Float!
  referral_count: Int! 
  referral_fee: Float!
  job_category: Int // obtain id from fields data
  industry: Int // obtain id from fields data
  employer_id: Int!
  company_detail_id: Int!
  qualifications: String
  minimum_qualification: String!
  minimum_experience: String!
  home_based: Boolean!
  traits: [{
      trait: String!
  }]!
  vat: Float!
  fee: Float!
  transaction_id: String! // obtained from Charging customer
  skills: [{
      skill_name: String!
      skill_description: Int!
  }]!
  city_id: Int // obtain id from fields data
  address: String
  status: String
  show_salary: Boolean
  visible: Boolean
  disbursement_type: String
  api_username: String!
  api_key: String!
}
```

### Getting Fields Data

    0. GET METHODS to these ENVIRONMENTS
    	- dev environment: https://share.dev.pasajob.com/get-fields-data
    	- prod environment: https://share.pasajob.com/get-fields-data
    1. The response will have all the data list for the following fields.
	   - Locations (country,province,city)
	   - Industries
	   - Job Categories
    
