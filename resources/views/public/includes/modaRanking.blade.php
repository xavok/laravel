<!-- Modal Alert Candidate ranking -->
<div class="modal fade" id="modalRanking">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Candidate Ranking</h4>
                <h4>55112154 Senior Software Developer</h4>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                    <th>Rank</th>
                    <th>Candidate ID</th>
                    <th>Percentage</th>
                    <th>Status</th>
                    </thead>
                    <tbody>
                    <?php
                    $a = 1;
                    for ($i = 0; $i < 10; $i++) {
                    ?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><a href="#modalCandidate" data-toggle="modal" id="candidate_<?php echo $i; ?>"
                               data-target="#modalCandidate">124312332</a>
                        </td>
                        <td>100%</td>

                        <td>Ready</td>
                    </tr>
                    <?php
                    }
                    ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <a href="#" data-dismiss="modal" class="btn btn-default">Close</a>
                <a href="#" class="btn btn-default">Notify</a>
                <!--                <a href="#" class="btn btn-default">Delete</a>-->
            </div>
            <br>
        </div>
    </div>
</div>
