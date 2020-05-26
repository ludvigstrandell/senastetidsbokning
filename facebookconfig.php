<?php
FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
});