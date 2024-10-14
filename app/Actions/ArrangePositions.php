<?php

namespace App\Actions;

use Illuminate\Support\Facades\DB;

class ArrangePositions
{
    public static function run(int $id)
    {
        DB::update("
            WITH RankedProposals AS (
                SELECT id, ROW_NUMBER() OVER (ORDER BY hours ASC) AS p
                FROM proposals
                WHERE project_id = ?
            )
            UPDATE proposals
            JOIN RankedProposals ON proposals.id = RankedProposals.id
            SET proposals.position = RankedProposals.p
            WHERE proposals.project_id = ?;
        ", [$id, $id]);
    }

}
