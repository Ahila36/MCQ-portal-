<body>
    <div ng-controller="loginCtrl" role="form">
        <div class="container">
            <div class="row">
                <div class="col-md-offset-5 col-md-3">
                    <div class="form-login">
                        <form action="/" id="myLogin">
                            Username: <input type="text" class="form-control input-sm chat-input" id="username" 
                                             ng-model="username" placeholder="please enter username" required> <br> <br>
                            Password: <input type="password" class="form-control input-sm chat-input" id="password" 
                                             ng-model="password" placeholder="please enter password" required>
                            <br>
                            <button align="center" type="button"  class="btn btn-primary" ng-click="submit()"> Login </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    

