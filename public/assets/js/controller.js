
  // creating Angular Module
  
  var app = angular.module('requestApp', []);
  
  // create angular controller and pass in $scope and $http
  app.controller('RequestController',function($scope, $http,$timeout) {
	  
	  $scope.formData; //formData is an object holding the name, email, subject, and message
	  
	  $scope.submitButtonDisabled = false;

	  // submission message doesn't show when page loads
	  $scope.submission = false;
	  
	  // Updated code thanks to Yotam
	  var param = function(data) {
			var returnString = '';
			for (d in data){
				if (data.hasOwnProperty(d))
				   returnString += d + '=' + data[d] + '&';
			}
			// Remove last ampersand and return
				return returnString.slice( 0, returnString.length - 1 );
		  };
		  $scope.submitForm = function() {
			$http({
			method : 'POST',
			url : 'request-form.php',
			data : param($scope.formData), // pass in data as strings
			headers : { 'Content-Type': 'application/x-www-form-urlencoded' } // set the headers so angular passing info as form data (not request payload)
		  })
			.success(function(data) {
			  if (!data.success) {
			   // if not successful, bind errors to error variables
			   $scope.errorName = data.errors.name;
			   $scope.errorPhone = data.errors.phone;
			   $scope.errorEmail = data.errors.email;
			   $scope.errorSubject = data.errors.subject;
			   $scope.submissionMessage = data.messageError;
			   $scope.submission = true; //shows the error message
			  } else {
			  // if successful, bind success message to message
			   $scope.submissionMessage = "";
			   $scope.successsubmissionMessage = data.messageSuccess;
			   $scope.formData = {}; // form fields are emptied with this line
			   $scope.submission = false; //shows the success message
			   $timeout(function(){$scope.successsubmissionMessage = ""
			   
			   },3000);
			  }
			 });
		   };
});
