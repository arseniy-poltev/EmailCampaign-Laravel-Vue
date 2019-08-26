@extends('admin.layouts.app')

@section('content')
<div class="row">
    <div class="col-md-10">
        <div class="panel panel-default">
            <div class="panel-heading">@lang('quickadmin.qa_dashboard')</div>

            <div class="panel-body">
                @lang('quickadmin.qa_dashboard_text')
            </div>
        </div>
    </div>
</div>
@endsection
@section('javascript')
<script src="https://www.gstatic.com/firebasejs/4.7.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/4.7.0/firebase-messaging.js"></script>
{{-- <script src={{ url('/js/firebase-messaging-sw.js')}}></script> --}}

<script>
    var config = {
        apiKey: "AAAAy20aFqc:APA91bGXsy5aUqnENn1yQH9Vfjr4r44tpsN2I24iZgVNqKaPsuF_jXrkci2dshRzpU6qGkV59zaVAHuXcMOEaWQ3qid7Fu7QCzzH8rvh4LC-03RoRTAvf0KW2W3aAXBHOfT-0hl6J9J5",
        authDomain: "targetuserweb.firebaseapp.com",
        messagingSenderId: "873708787367"
    };
    firebase.initializeApp(config);
    console.log("firebase");
    const messaging = firebase.messaging();
    
    messaging
        .requestPermission()
        .then(function () {
            console.log("Notification permission granted.");

            // get the token in the form of promise
            return messaging.getToken()
        })
        .then(function(token) {
            console.log(token);
             //save token to db
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            //set device token and timezone
            $.ajax({
                type:'post',
                url:'/api/common/setDeviceInfo',
                data:{
                    
                    token: token,
                    timezone:moment.tz.guess()
                },
                dataType: "json",
                success:function(resp){
                
                },
                fail:function(error){
                    console.log(error);
                }
            })
        })
        .catch(function (err) {
            // ErrElem.innerHTML =  ErrElem.innerHTML + "; " + err
            console.log("Unable to get permission to notify.", err);
        });
    window.messaging = messaging;
    // messaging.onMessage(function(payload) {
    //     console.log("Message received. ", payload);
    //         //NotisElem.innerHTML = NotisElem.innerHTML + JSON.stringify(payload) 
    // });    
</script>
@endsection