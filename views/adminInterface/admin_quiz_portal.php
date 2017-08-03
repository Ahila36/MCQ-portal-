<body data-ng-controller="quizCtrl">
    <div  data-ng-show="quizes.length > 0">
        <table  class="table table-hover">
            <thead>
                <tr>
                    <td># </td>
                    <td> quiz </td>
                    <td>delete quiz </td>
                </tr>
            </thead>
            <tbody>
                <tr data-ng-repeat="quiz in quizes track by $index">
                    <td>{{ $index + 1}}</td>
                    <td><a  href="#/admin_question/{{quizes[$index].id}}/{{userId}}" >
                            {{quizes[$index].name}}</a> </td>
                    <td> <button  class="btn btn-danger" ng-click="deleteQuiz(quizes[$index])"> DELETE </button> </td>
                </tr>
            </tbody>
        </table>
        <button class="btn btn-primary" ng-click="showInput()"> Add quiz </button>
        <div ng-show="myvalue" class="col-xs-4">
            <input  class="form-control" type="text" ng-model="quizname" ng-trim="false" />
            <button class="btn btn-primary" ng-click="saveQuiz()"> save quiz </button>
        </div>
    </div>
    
    
    
    
