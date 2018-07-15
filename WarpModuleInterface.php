<?php

namespace snakemkua\Warp12Bundle;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

interface WarpModuleInterface
{
 
    public function warpUIRenderLayout(Request $request) : Response;

    public function warpDropdownMenu(Request $request) : Response;

    public function warpTopLine(Request $request) : Response;
}
