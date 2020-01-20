<?php

include "../includes/header.php";
?>
<pre>
<?php print_r(getallheaders()); ?>
</pre>
<div class="container-fluid">
    <br />
    <div class="well">
        <h1 class="display-5">CitizenOne Application Sample</h1>
        <p class="lead">Building applications for the Citizen Ecosystem</p>
        <hr class="my-4">
        <p>A Sample application along with a tutorial to show off the features of CitizenOne.</p>
        <p class="lead">
            <a class="btn btn-primary btn-lg" href="/home/tutorial.php" role="button">Learn more</a>
        </p>
    </div>
    <div class="">
        <ol>
            <li>What is CitizenOne and why would I want to build an app for it?</li>
            <li>Security and privacy</li>
            <li>Connecting users</li>
            <li>Claim providers and rules ( and optional rules)</li>
            <li>Examples of the work flow and stuff.</li>
            <li>Clients and how to consume </li>
            <li>Receiving updates</li>
            <li>Providing status to the server card</li>
            <li>Sending notifications</li>
            <li>Delivering digital documents</li>
            <li>Consent and the right to be invisible</li>
        </ol>

    </div>
</div>

<?php
include "../includes/footer.php";
