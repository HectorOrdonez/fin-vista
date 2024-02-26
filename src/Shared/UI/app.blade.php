<html lang="en" class="h-full">
<head>
    <title>Fin-Vista</title>
    @vite('resources/css/app.css')

    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body class="font-poppins bg-primary h-full">
<x-components.flash></x-components.flash>
<x-components.nav></x-components.nav>

{{ $slot }}

</body>
</html>
