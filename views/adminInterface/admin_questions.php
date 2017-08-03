<h1> Questions </h1>
<body data-ng-controller="questionCtrl">

    <form>
        <div ng-show="!editMode">
            <div data-ng-repeat="question in questions track by $index">
                <label> {{ $index + 1}} {{questions[$index].question}}</label>
                <div data-ng-repeat="choice in choices track by $index">
                    <div ng-if="choices[$index].questionId === questions[$parent.$index].id">
                        <input type="radio" ng-value="{{choice.id}}" name="{{question.id}}" ng-model="value" ng-click="newValue(value)" />
                        <label> {{choices[$index].choice}} </label>


                    </div>
                </div>

            </div>
            <button class="btn btn-primary" ng-click="showInput()"> Add questions </button>
            <br>
            <br>
            <br>
        </div>
        <button class="btn btn-primary"  ng-click="edit()"> edit </button>
        &nbsp; &nbsp;  &nbsp; &nbsp;   <button class="btn btn-primary"  ng-click="save()"> save </button>
        <br>
        <br>


    </form>


    <div ng-show="showAddQ">
        <form  ng-submit="addQuestionAndChoices()">


            <div class="col-xs-4">
                <input type="text" class="form-control" name="question" ng-model="questionname" placeholder="Enter questions" required>
                <div class="col-xs-4">
                    <input type="text" class="form-control" name="answer1" ng-model="answer1" placeholder="Enter choice 1 " required><br>
                    <input type="text" class="form-control" name="answer2" ng-model="answer2" placeholder="Enter choice 2" required><br>
                    <input type="text" class="form-control" name="correctAns" ng-model="correctAns" placeholder="Enter correct answer" required>
                    <br>
                    <br>
                </div>
            </div>


            <button type="submit" class="btn btn-primary">Add question</button>
            <button class="btn btn-primary" ng-click="showView()"> Done</button>
        </form>
    </div>
    <div ng-show="editMode">
        <form>
            <div data-ng-repeat="question in questions track by $index">
                <div class="col-xs-4">
                    <input  type="text" class="form-control" ng-model-options="{ updateOn: 'blur' }" 
                            ng-change="updateQuestion(questions[$index])" ng-model="questions[$index].question">
                </div>
                <button class="btn btn-danger" ng-click="deleteQuestion(questions[$index])"> DELETE </button>
                <div>
                    <div data-ng-repeat="choice in choices track by $index">
                        <div ng-if="choices[$index].questionId === questions[$parent.$index].id">
                            <div class="col-xs-4">
                                &nbsp; &nbsp;  <input class="form-control" type="text" ng-model-options="{ updateOn: 'blur' }" 
                                                      ng-change="updateChoice(choices[$index])" ng-model="choices[$index].choice">
                                <br>
                                <br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button class="btn btn-primary" ng-click="view()"> Done </button>
            <br>
            <br>
            <br>
        </form>
    </div>
</body>







