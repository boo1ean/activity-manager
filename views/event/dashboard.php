<?php
    use yii\helpers\Html;
?>

<h3>Upcoming Events</h3>
<table class="table table-condensed">
    <thead>
        <!--Click on title to see full event description-->
        <th>Title</th>
        <th>Start Time</th>
        <!--Creator can edit/delete/invite-->
        <th>Actions</th>
    </thead>
    <tbody>
        <?php foreach($events as $event): ?>
            <tr>
                <td><a href="<?php echo Html::url(array('event/details', 'id' => $event->id));?>"><?php echo $event->title; ?></a></td>
                <td><?php echo $event->start_time; ?></td>
                <td>
                    <?php if (!Yii::$app->getUser()->getIsGuest()
                            && Yii::$app->getUser()->getIdentity()->getId() == $event->created_by): ?>
                        <a class="btn btn-info" href="<?php echo Html::url(array('event/invite', 'id' => $event->id));?>">
                            <i class="icon-info-sign icon-white"></i>Invite
                        </a>
                        <a class="btn btn-warning" href="<?php echo Html::url(array('event/edit', 'id' => $event->id));?>"><i class="icon-edit icon-white"></i>Edit</a>
                        <a class="btn btn-danger" href="<?php echo Html::url(array('event/delete', 'id' => $event->id));?>"><i class="icon-remove icon-white"></i>Delete</a>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach;?>
    </tbody>
</table>

<?php if (!Yii::$app->getUser()->getIsGuest()): ?>
    <a class="btn btn-success" href="<?php echo Html::url(array('event/add')); ?>">
        <i class="icon-plus icon-white"></i>Add new event
    </a>
<?php endif; ?>
