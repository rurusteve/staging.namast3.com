<style>
    html {
        width: 100%;
        height: 100%;
    }
    body {
        background-color: whitesmoke;
        color: rgba(0, 0, 0, 0.6);
        font-family: "Roboto", sans-serif;
        font-size: 14px;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }
    .labelhover:hover{
        cursor: pointer;
    }

    input[type="radio"]:hover,input[type="checkbox"]:hover,input[type="select"]:hover{
        cursor: pointer;
    }
    ol.decimal {list-style-type: decimal;}
    .ErrorMessage{
        color: red;
        max-width: 300px;
    }
    .submit-button{
        margin-top: 30px;
    }
    .sectioncontainer{
        display: flex;
        justify-content: center;
        align-content: center;
        align-self: center;
        flex-wrap: wrap;
    }
    .overlay, .form-panel.one:before {
        position: absolute;
        top: 0;
        left: 0;
        display: none;
        background: rgba(0, 0, 0, 0.8);
        width: 100%;
        height: 100%;
    }
    .form {
        z-index: 15;
        position: relative;
        background: #FFFFFF;
        width: 600px;
        border-radius: 4px;
        box-shadow: 0 0 30px rgba(0, 0, 0, 0.1);
        box-sizing: border-box;
        overflow: hidden;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .form-toggle {
        z-index: 10;
        position: absolute;
        top: 60px;
        right: 60px;
        background: #FFFFFF;
        width: 60px;
        height: 60px;
        border-radius: 100%;
        -webkit-transform-origin: center;
        transform-origin: center;
        -webkit-transform: translate(0, -25%) scale(0);
        transform: translate(0, -25%) scale(0);
        opacity: 0;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    .form-toggle:before, .form-toggle:after {
        content: '';
        display: block;
        position: absolute;
        top: 50%;
        left: 50%;
        width: 30px;
        height: 4px;
        background: #4285F4;
        -webkit-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
    }
    .form-toggle:before {
        -webkit-transform: translate(-50%, -50%) rotate(45deg);
        transform: translate(-50%, -50%) rotate(45deg);
    }
    .form-toggle:after {
        -webkit-transform: translate(-50%, -50%) rotate(-45deg);
        transform: translate(-50%, -50%) rotate(-45deg);
    }
    .form-toggle.visible {
        -webkit-transform: translate(0, -25%) scale(1);
        transform: translate(0, -25%) scale(1);
        opacity: 1;
    }
    .form-group {
        margin-top: 20px;
    }
    .form-group:last-child {
        margin: 0;
    }
    .form-group label {
        display: block;
        margin: 0 0 10px;
        color: rgba(0, 0, 0, 0.6);
        font-size: 12px;
        font-weight: 500;
        line-height: 1;
        text-transform: uppercase;
        letter-spacing: .2em;
    }
    .two .form-group label {
        color: #FFFFFF;
    }
    select:hover{
        cursor: pointer;
    }
    option:hover{
        cursor: pointer;
    }

    .form-group select {
        -webkit-appearance: none;
        -moz-appearance:    none;
        appearance:         none;
        outline: none;
        display: block;
        background: rgba(0, 0, 0, 0.1);
        width: 100%;
        border: 0;
        border-radius: 4px;
        box-sizing: border-box;
        padding: 12px 20px;
        color: rgba(0, 0, 0, 0.6);
        font-family: inherit;
        font-size: inherit;
        font-weight: 500;
        line-height: inherit;
        transition: 0.3s ease;
    }
    .form-group input {
        outline: none;
        display: block;
        background: rgba(0, 0, 0, 0.1);
        width: 100%;
        border: 0;
        border-radius: 4px;
        box-sizing: border-box;
        padding: 12px 20px;
        color: rgba(0, 0, 0, 0.6);
        font-family: inherit;
        font-size: inherit;
        font-weight: 500;
        line-height: inherit;
        transition: 0.3s ease;
    }
    .form-group input:focus {
        color: rgba(0, 0, 0, 0.8);
    }
    .two .form-group input {
        color: #FFFFFF;
    }
    .two .form-group input:focus {
        color: #FFFFFF;
    }

    .form-group select:focus {
        color: rgba(0, 0, 0, 0.8);
    }
    .two .form-group select {
        color: #FFFFFF;
    }
    .two .form-group select:focus {
        color: #FFFFFF;
    }
    .form-group button {
        outline: none;
        background: #4285F4;
        width: 100%;
        border: 0;
        border-radius: 4px;
        padding: 12px 20px;
        color: #FFFFFF;
        font-family: inherit;
        font-size: inherit;
        font-weight: 500;
        line-height: inherit;
        text-transform: uppercase;
        cursor: pointer;
    }
    .two .form-group button {
        background: #FFFFFF;
        color: #4285F4;
    }

    .form-group .form-remember {
        font-size: 12px;
        font-weight: 400;
        letter-spacing: 0;
        text-transform: none;
    }
    .form-group .form-remember input[type='checkbox'] {
        display: inline-block;
        width: auto;
        margin: 0 10px 0 0;
    }
    .form-group .form-recovery {
        color: #4285F4;
        font-size: 12px;
        text-decoration: none;
    }
    .form-panel {
        padding: 60px;
        box-sizing: border-box;
    }
    .form-panel.one:before {
        content: '';
        display: block;
        opacity: 0;
        visibility: hidden;
        transition: 0.3s ease;
    }
    .form-panel.one.hidden:before {
        display: block;
        opacity: 1;
        visibility: visible;
    }
    .form-panel.two {
        z-index: 5;
        position: absolute;
        top: 0;
        left: 95%;
        background: #4285F4;
        width: 100%;
        min-height: 100%;
        padding: 60px calc(10% + 60px) 60px 60px;
        transition: 0.3s ease;
        cursor: pointer;
    }
    .form-panel.two:before, .form-panel.two:after {
        content: '';
        display: block;
        position: absolute;
        top: 60px;
        left: 1.5%;
        background: rgba(255, 255, 255, 0.2);
        height: 30px;
        width: 2px;
        transition: 0.3s ease;
    }
    .form-panel.two:after {
        left: 3%;
    }
    .form-panel.two:hover {
        left: 93%;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }
    .form-panel.two:hover:before, .form-panel.two:hover:after {
        opacity: 0;
    }
    .form-panel.two.active {
        left: 10%;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        cursor: default;
    }
    .form-panel.two.active:before, .form-panel.two.active:after {
        opacity: 0;
    }
    .form-header {
        margin: 0 0 40px;
    }
    .form-header h1 {
        padding: 4px 0;
        color: #4285F4;
        font-size: 24px;
        font-weight: 700;
        text-transform: uppercase;
    }
    .two .form-header h1 {
        position: relative;
        z-index: 40;
        color: #FFFFFF;
    }

    .pen-footer {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        width: 600px;
        margin: 20px auto 100px;
    }
    .pen-footer a {
        color: #FFFFFF;
        font-size: 12px;
        text-decoration: none;
        text-shadow: 1px 2px 0 rgba(0, 0, 0, 0.1);
    }
    .pen-footer a .material-icons {
        width: 12px;
        margin: 0 5px;
        vertical-align: middle;
        font-size: 12px;
    }

    .cp-fab {
        background: #FFFFFF !important;
        color: #4285F4 !important;
    }
    .colored{
        color: #9c27b0 !important;
    }
    .colored:hover{
        color: #2196F3 !important;
    }
    .panel-span{
        background-color: yellow;
        float: right;
        padding: 10px;
    }
    .panel-span:hover{
        background-color: #ccc;
        cursor: pointer;
    }
    .main-title{
        color: #2d2d2d;
        text-align: center;
        text-transform: capitalize;
        padding: 0.7em 0;
    }

    .container{
        padding: 1em 0;
        float: left;
        width: 50%;
    }
    @media screen and (max-width: 640px){
        .container{
            display: block;
            width: 100%;
        }
    }

    @media screen and (min-width: 900px){
        .container{
            width: 33.33333%;
        }
    }

    .container .title{
        color: #1a1a1a;
        text-align: center;
        margin-bottom: 10px;
    }

    .headlinecontent {
        position: relative;
        margin: auto;
        overflow: hidden;
    }

    .headlinecontent .headlinecontent-overlay {
        background: rgba(0,0,0,0.7);
        position: absolute;
        height: 100%;
        width: 100%;
        left: 0;
        top: 0;
        bottom: 0;
        right: 0;
        opacity: 0;
        -webkit-transition: all 0.4s ease-in-out 0s;
        -moz-transition: all 0.4s ease-in-out 0s;
        transition: all 0.4s ease-in-out 0s;
    }

    .headlinecontent:hover .headlinecontent-overlay{
        opacity: 1;
    }

    .headlinecontent-image{
        width: 100%;
    }

    .headlinecontent-details {
        position: absolute;
        text-align: center;
        padding-left: 1em;
        padding-right: 1em;
        width: 100%;
        top: 50%;
        left: 50%;
        opacity: 0;
        -webkit-transform: translate(-50%, -50%);
        -moz-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
        -webkit-transition: all 0.3s ease-in-out 0s;
        -moz-transition: all 0.3s ease-in-out 0s;
        transition: all 0.3s ease-in-out 0s;
    }

    .headlinecontent:hover .headlinecontent-details{
        top: 50%;
        left: 50%;
        opacity: 1;
    }

    .headlinecontent-details h3{
        color: #fff;
        font-weight: 500;
        letter-spacing: 0.15em;
        margin-bottom: 0.5em;
        text-transform: uppercase;
    }

    .headlinecontent-details p{
        color: #fff;
        font-size: 0.8em;
    }

    .fadeIn-bottom{
        top: 80%;
    }

    .fadeIn-top{
        top: 20%;
    }

    .fadeIn-left{
        left: 20%;
    }

    .fadeIn-right{
        left: 80%;
    }
    .headlines__container{
        width: 100%;
        display: flex;
        max-width: 1200px;
    }
    .o-headlines.-firstimg{
        width: 100%;
        height: 500px;
        background-image: url("https://www.footballforpeace.id/wp-content/uploads/2018/07/DSC_6561-1024x680.jpg");
        background-size: cover;
        background-repeat: no-repeat;
        background-position: 50% 50%;
    }
    .o-headlines.-first{
    }
    .o-headlines.-second{
        width: 50%;
        display: flex;
        flex-flow: wrap column;
    }
    .m-headlines.-firstimg{
        width: 100%;
        height: 250px;
        background-image: url("https://www.footballforpeace.id/wp-content/uploads/2018/07/Screen-Shot-2018-07-13-at-14.10.35.png");
        background-size: cover;
        background-repeat: no-repeat;
        background-position: 50% 50%;
    }
    .m-headlines.-second{
        width: 100%;
        display: flex;
    }
    .a-headlines.-firstimg{
        height: 250px;
        background-image: url("https://d27p8o2qkwv41j.cloudfront.net/wp-content/uploads/2015/07/Property-registration-e1437553645318.jpg");
        background-size: cover;
        background-repeat: no-repeat;
        background-position: 50% 50%;
    }
    .a-headlines.-secondimg{
        height: 250px;
        background-image: url("https://www.footballforpeace.id/wp-content/uploads/2018/07/IMG-20180712-WA0036.jpg");
        background-size: cover;
        background-repeat: no-repeat;
        background-position: 50% 50%;
    }
    .o-headlines.-first{
        width: 50%;
    }
    .m-headlines.-first{
        width: 100%;
    }
    .a-headlines{
        width: 100%;
    }
</style>