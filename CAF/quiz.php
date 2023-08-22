<?php
	if (!isset($_SESSION)) {
        session_start();
    }
	include "conexion.php";
	if(empty($_SESSION['active'])){
		header('location: ../');
	}

$query = "SELECT * FROM pregunta";
$result = mysqli_query($conection, $query);

// Obtener las opciones de respuesta para cada pregunta
$questions = array();
while ($row = mysqli_fetch_assoc($result)) {
    $question = $row;
    $question['opciones'] = array();
    
    $optionsQuery = "SELECT * FROM opciones WHERE pregunta_id = " . $row['id_pregunta'];
    $optionsResult = mysqli_query($conection, $optionsQuery);
    while ($optionRow = mysqli_fetch_assoc($optionsResult)) {
        $question['opciones'][] = $optionRow;
    }
    
    $questions[] = $question;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $score = 0;

    foreach ($questions as $question) {
        $selectedOption = $_POST['question_' . $question['id_pregunta']];

        $optionsQuery = "SELECT id_opciones, correcta FROM opciones WHERE pregunta_id = " . $question['id_pregunta'];
        $optionsResult = mysqli_query($conection, $optionsQuery);

        while ($optionRow = mysqli_fetch_assoc($optionsResult)) {
            $optionId = $optionRow['id_opciones'];
            $isCorrect = $optionRow['correcta'];

            if ($selectedOption == $optionId && $isCorrect) {
                $score++;
            }
        }
    }

    echo "Tu puntaje es: " . $score . " / " . count($questions);
}

?>



<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>

	<style>
		/* Estilos generales */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
}

.quiz-form {
    max-width: 600px;
    margin: 0 auto;
    padding: 20px;
    background-color: #fff;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
}

.question {
    font-size: 18px;
    font-weight: bold;
    margin-bottom: 10px;
    color: #6f42c1;
}

.options {
    list-style: none;
    padding-left: 0;
}

.radio-option {
    display: inline-block;
    margin-right: 15px;
    cursor: pointer;
    color: #343a40;
}

.submit-btn {
    margin-top: 15px;
}

/* Estilos específicos para el botón */
.btn-kahoot {
    background-color: #6f42c1;
    color: #fff;
    border-color: #6f42c1;
    padding: 10px 20px;
    font-size: 16px;
    border-radius: 5px;
}

.btn-kahoot:hover {
    background-color: #5a2d9b;
    border-color: #5a2d9b;
}

	</style>

	<form action="sistema/salir.php" method="post">
		<button type="submit">Salir</button>
	</form>

		<h1>Bienvenido: <?php echo $_SESSION['user'];  ?> </h1>

	<div class="contenedor">
	<?php
// Mostrar las preguntas y opciones en la página
if (!empty($questions)) {
    echo '<form method="POST" class="quiz-form">';
    
    foreach ($questions as $question) {
        echo "<div class='question'>" . $question['pregunta_text'] . "</div>";
        echo "<ul class='options'>";
        foreach ($question['opciones'] as $option) {
            echo "<li><label class='radio-option'><input type='radio' name='question_" . $question['id_pregunta'] . "' value='" . $option['id_opciones'] . "'>" . $option['opcion_text'] . "</label></li>";
        }
        echo "</ul>";
    }
    
    echo "<button class='btn btn-kahoot submit-btn' type='submit'>Responder</button>";
    echo '</form>';
}
?>


	</div>
</body>
</html>