<link rel="stylesheet" href="../node_modules/bootstrap-icons/font/bootstrap-icons.css">
<link href="../node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="../node_modules/style.css" rel="stylesheet">
<script src="../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="../node_modules/jquery/dist/jquery.min.js"></script>
<link rel="stylesheet" href='../back/root.css'>
<script>
    function Mdy(dateString) {
        const date = new Date(dateString);
        const options = {
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        };
        return date.toLocaleDateString(undefined, options);
    }

    function generateUsername(fname, mname, lname) {
        var first = fname;
        var second = fname;
        var middle = mname;
        var last = lname;
        var newUser = last.split(" ")[0].toLowerCase() + first.charAt(0).toLowerCase();
        if (first.indexOf(" ") > -1) {
            var firstNameParts = first.split(" ");
            newUser += firstNameParts[1].charAt(0).toLowerCase();
        }
        if (middle) {
            newUser += middle.charAt(0).toLowerCase();
        }
        return newUser;
    }
</script>