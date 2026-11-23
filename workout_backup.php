<!DOCTYPE html>
<html>
<head>

<title>Workout Plan</title>

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>

body{
    font-family:Arial;
    background:#f5f5f5;
    margin:0;
    padding:20px;
}

.container{
    max-width:450px;
    margin:auto;
}

.card{
    background:white;
    padding:15px;
    margin-bottom:15px;
    border-radius:15px;
    box-shadow:0 0 10px rgba(0,0,0,0.1);
}

h1{
    text-align:center;
    color:#4CAF50;
}

.day{
    font-size:20px;
    font-weight:bold;
    color:#333;
    margin-bottom:10px;
}

.exercise{
    margin-top:10px;
    padding:10px;
    background:#f8f8f8;
    border-radius:10px;
}

.exercise img{
    width:100%;
    border-radius:10px;
    margin-bottom:10px;
}

</style>

</head>

<body>

<div class="container">

<h1>🏋 Weight Gain Workout</h1>

```html
<div class="card">

<div class="day">Monday – Chest & Triceps</div>

<div class="exercise">
<img src="images/pushup.gif">
<b>Push-ups</b><br>
3 × 10–15 Reps<br><br>
<button onclick="startExercise('Push-ups')">Start Exercise</button>
</div>

<div class="exercise">
<img src="images/floorpress.gif">
<b>Dumbbell Floor Press</b><br>
3 × 12 Reps<br><br>
<button onclick="startExercise('Dumbbell Floor Press')">Start Exercise</button>
</div>

<div class="exercise">
<img src="images/dumbbellflyes.gif">
<b>Dumbbell Flyes</b><br>
3 × 12 Reps<br><br>
<button onclick="startExercise('Dumbbell Flyes')">Start Exercise</button>
</div>

<div class="exercise">
<img src="images/chairdips.gif">
<b>Chair Dips</b><br>
3 × 10 Reps<br><br>
<button onclick="startExercise('Chair Dips')">Start Exercise</button>
</div>

<div class="exercise">
<img src="images/tricepextension.gif">
<b>Overhead Dumbbell Tricep Extension</b><br>
3 × 12 Reps<br><br>
<button onclick="startExercise('Tricep Extension')">Start Exercise</button>
</div>

</div>

<script>
function startExercise(name)
{
    alert(name + " started!");
}
</script>
```

<div class="card">

<div class="day">Tuesday</div>

<div class="exercise">
<b>Lunges</b><br>
3 × 10 Reps
</div>

<div class="exercise">
<b>Wall Push Ups</b><br>
3 × 10 Reps
</div>

<div class="exercise">
<b>Plank</b><br>
30 Seconds
</div>

</div>

<div class="card">

<div class="day">Wednesday</div>

<div class="exercise">
Rest Day 😴
</div>

</div>

<div class="card">

<div class="day">Thursday</div>

<div class="exercise">
<b>Push Ups</b><br>
3 × 10 Reps
</div>

<div class="exercise">
<b>Squats</b><br>
3 × 15 Reps
</div>

<div class="exercise">
<b>Plank</b><br>
40 Seconds
</div>

</div>

<div class="card">

<div class="day">Friday</div>

<div class="exercise">
<b>Lunges</b><br>
3 × 12 Reps
</div>

<div class="exercise">
<b>Chair Dips</b><br>
3 × 8 Reps
</div>

<div class="exercise">
<b>Plank</b><br>
40 Seconds
</div>

</div>

<div class="card">

<div class="day">Saturday</div>

<div class="exercise">
Full Body Workout 💪
</div>

</div>

<div class="card">

<div class="day">Sunday</div>

<div class="exercise">
Rest Day 😴
</div>

</div>

</div>

</body>
</html>