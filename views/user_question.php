<h1> Questions </h1>
<body data-ng-controller="userQuestionCtrl">
    <form>
        <div data-ng-repeat="question in questions track by $index">
            <label> {{ $index + 1}} {{questions[$index].question}}</label>
            <div data-ng-repeat="choice in choices track by $index">
                <div ng-if="choices[$index].questionId === questions[$parent.$index].id">
                    <input type="radio" ng-value="{{choice.id}}" name="{{question.id}}" ng-model="value" ng-click="newValue(value)" />
                    <label> {{choices[$index].choice}} </label>
                </div>
            </div>
        </div>
        <button ng-click="save()"> save </button>
    </form>
</body>
</html>


