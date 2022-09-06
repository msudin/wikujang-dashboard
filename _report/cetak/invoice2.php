<!DOCTYPE html>
<html>
<head>
    <style type="text/css" media="print">
  @page {
    size: auto;   /* auto is the initial value */
    margin: 0;  /* this affects the margin in the printer settings */
    padding: 30px;
  }
  body{
    padding: 30px;
  }
  </style>
</head>
<body>
  <p>Hello world, print me please</p>
  <p>Hello world, print me please</p>
  <p>Hello world, print me please</p>
  <p>Hello world, print me please</p>
  <p>Hello world, print me please</p>

  
<script src="https://code.jquery.com/jquery-2.2.4.js"></script>
  <script>
  $(document).ready(function () {
    window.print();
  });
  </script>
</body>
</html>