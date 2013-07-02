<h3>Upcoming Events</h3>
<table class="table table-condensed">
    <thead>
        <tr>
            <!--Click on title to see full event description-->
            <td>Title</td>
            <td>Start Time</td>
            <!--Creator can edit/delete/invite-->
            <td>Actions</td>
        </tr>
    </thead>
    <tbody>
        <?php foreach($events as $event): ?>
            <tr>
                <td><a href="#"><?php echo $event->title; ?></a></td>
                <td><?php echo $event->start_time; ?></td>
                <td>
                    <?php if (!Yii::$app->getUser()->getIsGuest()
                            && Yii::$app->getUser()->getIdentity()->getId() == $event->created_by): ?>
                        <a href="#">Invite</a>
                        <a href="#">Edit</a>
                        <a href="#">Delete</a>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach;?>
    </tbody>
</table>

<?php if (!Yii::$app->getUser()->getIsGuest()): ?>
    <a href="#">+Add new event</a>
<?php endif; ?>
