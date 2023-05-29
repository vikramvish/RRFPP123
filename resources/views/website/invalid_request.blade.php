<!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <style>
                @import url(https://fonts.googleapis.com/css?family=Raleway:700);

                *,
                *:before,
                *:after {
                    box-sizing: border-box;
                }

                html {
                    height: 100%;
                }

                body {
                    font-family: 'Raleway', sans-serif;
                    background-color: #342643;
                    height: 100%;
                    padding: 10px;
                }

                a {
                    color: #EE4B5E !important;
                    text-decoration: none;
                }

                a:hover {
                    color: #FFFFFF !important;
                    text-decoration: none;
                }

                .text-wrapper {
                    height: 100%;
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                    justify-content: center;
                }

                .title {
                    font-size: 5em;
                    font-weight: 700;
                    color: #EE4B5E;
                }

                .subtitle {
                    font-size: 40px;
                    font-weight: 700;
                    color: #1FA9D6;
                }

                .isi {
                    font-size: 18px;
                    text-align: center;
                    margin: 30px;
                    padding: 20px;
                    color: white;
                }

                .buttons {
                    margin: 30px;
                    font-weight: 700;
                    border: 2px solid #EE4B5E;
                    text-decoration: none;
                    padding: 15px;
                    text-transform: uppercase;
                    color: #EE4B5E;
                    border-radius: 26px;
                    transition: all 0.2s ease-in-out;
                    display: inline-block;

                    .buttons:hover {
                        background-color: #EE4B5E;
                        color: white;
                        transition: all 0.2s ease-in-out;
                    }
                }
                }
            </style>
        </head>

        <body>
            {{-- <div class="alert alert-danger">You are not authorized to access this page.</div>   --}}
            <div class="text-wrapper">
                <div class="title" data-content="404">
                    404 - Oops, Invalid Request
                </div>
                <div class="subtitle">
                    ACCESS DENIED.
                </div>
                {{-- <div class="isi">
                    You have To take Permission from <span style="color: #1FA9D6;font-size: 25px;"> super admin </span>
                    to access this page.!
                </div> --}}
                <div class="buttons">
                    <a class="button" href="{{ url('/website') }}">Go to Home</a>
                </div>
            </div>
        </body>

        </html>