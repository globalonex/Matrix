<?php
/*
 * *************************************************************************
 *  * Copyright (C) GlobalOneX, Inc - All Rights Reserved
 *  *
 *  * All rights reserved. No part of this project may be reproduced, distributed or
 *  * transmitted in any form or by any means, including photocopying, recording or other
 *  * electronic or mechanical methods, without the prior written permission of the
 *  * copyright owner.
 *  *
 *  * @file        /src/Services/MatrixReferralSystem.php
 *  * @author      GlobalOneX
 *  * @site        <null>
 *  * @date        10.03.2023 17:25
 *
 */

namespace MatrixRef\Services;

class MatrixReferralSystem
{
    private array $matrix = array();

    /**
     *
     * This class represents the matrix structure of the referral system.
     * The addMember() method adds a new member to the system using the ID of the parent member.
     * If the parent participant is not found, the method returns false.
     * If the participant already exists in the system, the method also returns false.
     * If the participant is successfully added to the system, the method returns true.
     *
     * @param $parent_id
     * @param $member_id
     * @return array|bool
     */
    public function addMember($parent_id, $member_id): array|bool
    {
        if (empty($this->matrix)) {
            $this->matrix[0][0] = $member_id;
            return true;
        }
        $member_index = $this->findIndex($member_id);
        if ($member_index) {
            return false;
        }
        $parent_index = $this->findIndex($parent_id);
        if (!$parent_index) {
            return false;
        }
        $row = $parent_index[0];
        $col = $parent_index[1] + 1;
        if (empty($this->matrix[$row][$col])) {
            $this->matrix[$row][$col] = $member_id;
            return true;
        }
        // If the next position is already filled, try to find a lower position in the next row
        $next_row = $row + 1;

        for ($i = $col; $i < count(@(array)$this->matrix[$next_row]); $i++) {
            if (empty($this->matrix[$next_row][$i])) {
                $this->matrix[$next_row][$i] = $member_id;
                return true;
            }
        }


        // If there's no available position in the current and next row, add a new row
        $this->matrix[$next_row][0] = $member_id;
        return true;
    }

    /**
     * A simple method for finding an index in a matrix array
     *
     * @param $member_id
     * @return bool|array
     */
    private function findIndex($member_id): bool|array
    {
        foreach ($this->matrix as $row_index => $row) {
            foreach ($row as $col_index => $col) {
                if ($col == $member_id) {
                    return array($row_index, $col_index);
                }
            }
        }
        return false;
    }

    public function getMatrix() : array {
        return $this->matrix;
    }

}
