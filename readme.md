Restful api for Ionic 3 app - SoccerReviewer

**Show Players**
----
  Returns json data about a single player.

* **URL**

  api/v1/players/id

* **Method:**

  `GET`
  
*  **URL Params**

   **Required:**
 
   `id=[integer]`

**Show reviews**

 api/v1/reviews/id

 ## unit testing & coverage command
 
 ```phpunit --log-junit reports/unitReport.xml --coverage-clover reports/coverage/coverage.xml```