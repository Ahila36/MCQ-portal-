<body data-ng-controller="userQuizCtrl">
    <h1> Quiz for users </h1>
    <div  data-ng-show="quizes.length > 0">
        <table >
            <thead>
            </thead>
            <tbody>
                <tr data-ng-repeat="quiz in quizes track by $index">
                    <td>{{ $index + 1}}</td>
                    <td><a  href="#/user_question/{{quizes[$index].id}}/{{userId}}" >
                            {{quizes[$index].name}}</a> </td>
                </tr>
            </tbody>
        </table>
    </div>

    
    
