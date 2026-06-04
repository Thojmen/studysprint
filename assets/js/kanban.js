function allowDrop(ev)
{
    ev.preventDefault();
}

function drag(ev)
{
    ev.dataTransfer.setData(
        "text",
        ev.target.id
    );
}

function drop(ev)
{
    ev.preventDefault();

    const taskId =
        ev.dataTransfer.getData("text");

    const task =
        document.getElementById(taskId);

    const column =
        ev.currentTarget;

    column.appendChild(task);

    const dbTaskId =
        taskId.replace("task-", "");

    const status =
        column.dataset.status;

    const formData =
        new FormData();

    formData.append(
        "task_id",
        dbTaskId
    );

    formData.append(
        "status",
        status
    );

    fetch(
        "update-task-status.php",
        {
            method: "POST",
            body: formData
        }
    );
}