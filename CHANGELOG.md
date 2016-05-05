1.0
  - Created OpenAppStore
  - Basic config options
  - Ability to add apps to the database through addapp.php
1.1
  - file uploads
    - Redirect after upload complete to Add App page to add file as a new software
  - Ability to change homepage color
  - Ability to configure forced SSL redirects
  - Added footer to more pages
  - Fixed an error where SSL enabled sites would get a mixed HTTP/HTTPS warning from Google Chrome because Google Fonts would load over HTTP.
  - Lots of other stuff
2.0
  - Stopped using pass.php to store admin passwords
    - You can also optionally allow people to sign up, although there are no features added by doing so
    - Passwords are stored using PHP Login Minimal (https://github.com/panique/php-login-minimal) in the MySQL database
      - Because login info is stored in $_SESSION[], you no longer have to type a password every time you add an app, etc.
  - Created an admin area
    - Features include:
      - Ability to delete posts
      - Upload files/Add Apps
      - Change various settings that used to require editing config.php
      - MATERIAL DESIGN (OOOOHHHHHH!!!)
        - I plan on changing more parts of OpenAppStore to material design in the near future
      - More....
  - Footer is customized when admin is logged in.
  - Security Fixes
  - Much more
