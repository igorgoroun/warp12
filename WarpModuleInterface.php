<?php

namespace snakemkua\Warp12Bundle;

use Symfony\Component\HttpFoundation\Request;

interface WarpModuleInterface
{
    public function warpDropdownMenu(Request $request);

    public function warpUIRenderLayout(Request $request);

    public function warpTopLine(Request $request);
}
