<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= $name ?>></title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            font-family: 'Nunito', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }

        .title {
            display: block;
            background-color: #882828;
            color: white;
            margin: 0;
            padding: 1em;
            text-align: center;
        }

        .subtitle {
            display: block;
            background-color: #a33937;
            color: white;
            margin: 0;
            padding: 1em;
            text-align: center;
        }

        .btn-list {
            display: flex;
            justify-content: flex-start;
            align-items: center;
            list-style-type: none;
            margin-left: 5em;
            padding: 1em;
        }

        .btn-list li {

        }

        .tab-link {
            display: block;
            outline: none;
            text-decoration: none;
            background-color: #aaa;
            color: #000;
            padding: .5em 1em;
            margin-right: 1em;
        }

        .tab-link.active {
            background-color: #292B2F;
            color: #fff;
        }

        p {
            margin: 0;
        }

        .panel {
            display: none;
            margin: 0 5em;
        }

        .panel.active {
            display: flex;
        }

        .panel.error {
            background-color: #292B2F;
            padding: 1em;
            color: #fff;
        }

        .panel.stackTrace {
            flex-direction: column;
            overflow-y: scroll;
            max-height: 70vh;
        }

        .stackTraceItem {
            background-color: #292B2F;
            color: #fff;
            padding: 0;
            padding: 1em;
            margin-bottom: 1em;
            list-style-type: none;
        }

        pre {
            margin: 0;
            /*font-family: 'Nunito', sans-serif;*/
        }
    </style>
</head>
<body>
<h3 class="title">500 | Internal server error</h3>
<h2 class="subtitle"><?= $name ?></h2>

<ul class="btn-list">
    <li><a href="#" class="tab-link active" data-panel="error">Error</a></li>
    <li><a href="#" class="tab-link" data-panel="stackTrace">Stacktrace</a></li>
</ul>

<div class="panels">

    <div class="panel active error" id="error">
        <p><?= $name ?></p>
    </div>

    <div class="panel stackTrace" id="stackTrace">

        <?php foreach ($error as $msg): ?>
            <div class="stackTraceItem">

                <pre><?php print_r($msg) ?></pre>

            </div>
        <?php endforeach; ?>

    </div>

</div>

<script>
    let tabBtns = document.querySelectorAll('.tab-link');
    let panels = document.querySelectorAll('.panel');

    tabBtns.forEach((elt) => elt.addEventListener('click', (event) => {
        event.preventDefault();

        document.querySelectorAll('.active').forEach((elt) => {
            elt.classList.remove('active');
        })

        elt.classList.add('active');
        document.querySelector('#' + elt.getAttribute('data-panel')).classList.add('active');
    }));
</script>
</body>
</html>
