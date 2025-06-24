<?php
$tasks = [];
$exit = false;
function showMenu() {
    echo "\n--- TO-DO LIST MENU ---\n";
    echo "1. Add Task\n";
    echo "2. View Tasks\n";
    echo "3. Mark Task as Done\n";
    echo "4. Delete Task\n";
    echo "5. Exit\n";
    echo "Enter your choice: ";
}

function addTask(&$tasks) {
    $task = readline("Enter new task: ");
    array_push($tasks,$task);
    echo "Task added.\n";
}

function viewTasks($tasks) {
    echo "\n--- Your Tasks ---\n";
    if (count($tasks) == 0) {
        echo "No tasks yet.\n";
        return;
    }
    for ($i = 0; $i < count($tasks); $i++) {
        echo ($i + 1) . ". " . $tasks[$i] . "\n";
    }
}

function markDone(&$tasks) {
    viewTasks($tasks);
    $index = readline("Enter task number to mark as done: ");
    $i = (int)$index - 1;

    if (isset($tasks[$i])) {
        $taskParts = explode(" [", $tasks[$i]);
        $tasks[$i] = $taskParts[0] . " [✔]";
        echo "Marked as done.\n";
    } else {
        echo "Invalid task number.\n";
    }
}

function deleteTask(&$tasks) {
    viewTasks($tasks);
    $index = readline("Enter task number to delete: ");
    $i = (int)$index - 1;

    if (isset($tasks[$i])) {
        unset($tasks[$i]);
        $tasks = array_values($tasks); // Reindex the array
        echo "Task deleted.\n";
    } else {
        echo "Invalid task number.\n";
    }
}

function mainMenu(&$tasks) {
    showMenu();
    $choice = readline();

    switch ($choice) {
        case "1":
            addTask($tasks);
            break;
        case "2":
            viewTasks($tasks);
            break;
        case "3":
            markDone($tasks);
            break;
        case "4":
            deleteTask($tasks);
            break;
        case "5":
            echo  "Exiting To-Do App. Bye!\n";
            return; 
        default:
            echo "Invalid option. Try again.\n";
    }

    mainMenu($tasks);
}


mainMenu($tasks);
?>