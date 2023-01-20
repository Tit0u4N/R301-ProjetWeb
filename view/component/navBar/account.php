<?php
      $basketLink = 'onclick="openPanel(\'basket\')"';
      $accountLink = 'href="?Connexion"';
      if($connexionValidation){
            $accountLink = 'onclick="openPanel(\'account\')"'; 
      }
      if($_SESSION["webMaster"]){
            $basketLink = 'href="?Stock"';
      }
?>
<div>
  <a <?=  $basketLink ?>>
  <?php
      if($_SESSION["webMaster"]){
      ?>
      <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="50" height="50" viewBox="0 0 256 256" xml:space="preserve">
            <defs>
            </defs>
            <g style="stroke: none; stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: none; fill-rule: nonzero; opacity: 1;" transform="translate(1.4065934065934016 1.4065934065934016) scale(2.81 2.81)" >
                  <path d="M 87.994 0 H 69.342 c -1.787 0 -2.682 2.16 -1.418 3.424 l 5.795 5.795 l -33.82 33.82 L 28.056 31.196 l -3.174 -3.174 c -1.074 -1.074 -2.815 -1.074 -3.889 0 L 0.805 48.209 c -1.074 1.074 -1.074 2.815 0 3.889 l 3.174 3.174 c 1.074 1.074 2.815 1.074 3.889 0 l 15.069 -15.069 l 14.994 14.994 c 1.074 1.074 2.815 1.074 3.889 0 l 1.614 -1.614 c 0.083 -0.066 0.17 -0.125 0.247 -0.202 l 37.1 -37.1 l 5.795 5.795 C 87.84 23.34 90 22.445 90 20.658 V 2.006 C 90 0.898 89.102 0 87.994 0 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(255,255,255); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                  <path d="M 65.626 37.8 v 49.45 c 0 1.519 1.231 2.75 2.75 2.75 h 8.782 c 1.519 0 2.75 -1.231 2.75 -2.75 V 23.518 L 65.626 37.8 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(255,255,255); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                  <path d="M 47.115 56.312 V 87.25 c 0 1.519 1.231 2.75 2.75 2.75 h 8.782 c 1.519 0 2.75 -1.231 2.75 -2.75 V 42.03 L 47.115 56.312 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(255,255,255); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                  <path d="M 39.876 60.503 c -1.937 0 -3.757 -0.754 -5.127 -2.124 l -6.146 -6.145 V 87.25 c 0 1.519 1.231 2.75 2.75 2.75 h 8.782 c 1.519 0 2.75 -1.231 2.75 -2.75 V 59.844 C 41.952 60.271 40.933 60.503 39.876 60.503 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(255,255,255); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                  <path d="M 22.937 46.567 L 11.051 58.453 c -0.298 0.298 -0.621 0.562 -0.959 0.8 V 87.25 c 0 1.519 1.231 2.75 2.75 2.75 h 8.782 c 1.519 0 2.75 -1.231 2.75 -2.75 V 48.004 L 22.937 46.567 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(255,255,255); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
            </g>
      </svg>
      <?php
      }
      else{     
      ?>
      <svg width="53" height="53" viewBox="0 0 53 53" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M38.0496 45.4917H14.9504C13.4461 45.4963 11.9892 44.9656 10.8402 43.9946C9.69126 43.0237 8.9251 41.6757 8.67876 40.1917L5.34418 20.0958H47.6558L44.3213 40.1917C44.0749 41.6757 43.3088 43.0237 42.1598 43.9946C41.0108 44.9656 39.5539 45.4963 38.0496 45.4917V45.4917Z"
            stroke="var(--background)" stroke-width="3.2" stroke-miterlimit="10"/>
      <path d="M51.8959 20.0958H1.10419" stroke="var(--background)" stroke-width="3.2"
            stroke-miterlimit="10"/>
      <path d="M15.9221 24.3358V20.0958L22.26 5.3" stroke="var(--background)" stroke-width="3.2"
            stroke-miterlimit="10" class="cove"/>
      <path d="M37.0779 24.3358V20.0958L30.74 5.3" stroke="var(--background)" stroke-width="3.2"
            stroke-miterlimit="10" class="cove"/>
      <path d="M26.5 28.5758V39.1538" stroke="var(--background)" stroke-width="3.2" stroke-miterlimit="10"/>
      <path d="M18.0421 28.5758V39.1538" stroke="var(--background)" stroke-width="3.2"
            stroke-miterlimit="10"/>
      <path d="M34.9579 28.5758V39.1538" stroke="var(--background)" stroke-width="3.2"
            stroke-miterlimit="10"/>
    </svg>
    <?php
      }         
      ?>

    

  </a>

  <a <?= $accountLink ?> >
      <svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M25 27.0417C31.5929 27.0417 36.9375 21.6971 36.9375 15.1042C36.9375 8.51127 31.5929 3.16667 25 3.16667C18.4071 3.16667 13.0625 8.51127 13.0625 15.1042C13.0625 21.6971 18.4071 27.0417 25 27.0417Z"
                  stroke="var(--background)" stroke-width="3.2" stroke-miterlimit="10"/>
            <path d="M3.125 48.9167L3.89583 44.6458C4.80645 39.7135 7.41612 35.2559 11.2715 32.0476C15.1268 28.8392 19.9843 27.0828 25 27.0833V27.0833C30.0217 27.0845 34.8839 28.8469 38.7401 32.0636C42.5963 35.2803 45.2022 39.7475 46.1042 44.6875L46.875 48.9583"
                  stroke="var(--background)" stroke-width="3.2" stroke-miterlimit="10"/>
      </svg>
  </a>
</div>