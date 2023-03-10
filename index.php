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
 *  * @file        index.php
 *  * @author      GlobalOneX
 *  * @site        <null>
 *  * @date        10.03.2023 17:25
 *
 */

namespace GlobalOneX\MatrixRef;

require_once __DIR__ . '/vendor/autoload.php';

use MatrixRef\Services\MatrixReferralSystem;
use MatrixRef\Services\RenderMatrix;

$referralSystem = new MatrixReferralSystem();
$referralSystem->addMember(null, 'A'); // add first member
$referralSystem->addMember('A', 'B');
$referralSystem->addMember('A', 'C');
$referralSystem->addMember('B', 'D');
$referralSystem->addMember('B', 'E');
$referralSystem->addMember('G', 'F');
$referralSystem->addMember('A', 'G');
$referralSystem->addMember('G', 'F');
$referralSystem->addMember('F', 'T');
$referralSystem->addMember('H', 'R');

$render = new RenderMatrix();

echo $render->getVector($referralSystem, count($referralSystem->getMatrix()), 7); // Special function which render vector matrix pyramid