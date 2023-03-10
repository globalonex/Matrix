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
 *  * @file        /src/Services/RenderMatrix.php
 *  * @author      GlobalOneX
 *  * @site        <null>
 *  * @date        10.03.2023 17:25
 *
 */

namespace MatrixRef\Services;

class RenderMatrix
{

    public function getVector(MatrixReferralSystem $referralSystem, int $rows = 3, int $cols = 6): string
    {

        $arf = json_encode((array)$referralSystem->getMatrix());

        return '
    <h1 style="font-family:monospace; text-align:center;">Global Production</h1>

    <canvas id="matrixCanvas"></canvas>

    <script>
      const canvas = document.getElementById("matrixCanvas");
      const ctx = canvas.getContext("2d");
      const width = canvas.width;
      const height = canvas.height;
      const numRows = '.$rows.';
      const numCols = '.$cols.';
      const vectorLength = 20;
      const matrix1 = [
        [0, 2, 0],
        [4, 5, 6],
        [7, 8, 9]
      ];
      
      const matrix = ' .$arf. ';
        console.log(matrix);
      ctx.translate(width / 2, height / 2);

      for (let i = 0; i < numRows; i++) {
        const row = matrix[i];

        for (let j = 0; j < numCols; j++) {
          if (row[j] === undefined) {
              console.log(row);
              row[j] = row.splice(j, 1);
              console.log(row);
          }
          const value = row[j];


          const x = (j - (numCols - 1) / 2) * vectorLength * 2;
          const y = (i - (numRows - 1) / 2) * vectorLength * 2;
          const vectorStart = { x, y };
          const vectorEnd = { x: x + value * vectorLength, y };


          drawVector(vectorStart, vectorEnd, i, value);
        }
      }

      function drawVector(start, end, i, value) {
        ctx.beginPath();
        ctx.moveTo(start.x, start.y);
        ctx.fillStyle = "blue";
        ctx.font = "bold 16px Arial";
        ctx.textAlign = "center";
        ctx.textBaseline = "middle";

        if (value !== 0 || undefined) {
          ctx.fillText(value, start.x, start.y);
        }

        ctx.stroke();



      }
    </script>
    <small>Project Version 0.1</small>
    
    <br>
    <small style="color:gray;"">All rights reserved. No part of this project may be reproduced, distributed or
transmitted in any form or by any means, including photocopying, recording or other
electronic or mechanical methods, without the prior written permission of the
copyright owner.</small>
';
    }

}