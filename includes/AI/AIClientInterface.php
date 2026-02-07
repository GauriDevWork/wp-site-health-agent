<?php

namespace WSHA\AI;

interface AIClientInterface
{
    public function explain(string $prompt): string;
}
