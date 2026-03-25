<?php
$file = 'openapi.yaml';
$content = file_get_contents($file);

$paramBlock = "      parameters:
        - name: Authorization
          in: header
          required: true
          schema:
            type: string
          description: 'Bearer <token>'";

$refParamLine = "\n        - name: Authorization\n          in: header\n          required: true\n          schema:\n            type: string\n          description: 'Bearer <token>'";

$lines = explode("\n", str_replace("\r", "", $content));
$newLines = [];

for ($i = 0; $i < count($lines); $i++) {
    $line = $lines[$i];
    $newLines[] = $line;
    
    // if we find BearerAuth: []
    if (trim($line) === '- BearerAuth: []') {
        // check if next line is `parameters:`
        $nextLine = rtrim($lines[$i+1] ?? '');
        if (trim($nextLine) === 'parameters:') {
            // It has parameters. We will let the loop copy 'parameters:'
            // then we'll insert our custom parameter right after it
            $newLines[] = $lines[$i+1]; // add `parameters:` 
            // now insert our lines
            foreach (explode("\n", $refParamLine) as $refL) {
                if ($refL !== '') {
                    $newLines[] = $refL;
                }
            }
            $i++; // skip next line since we copied it
        } else {
            // It doesn't have parameters (or it's further down, but usually it's close or absent)
            // Wait, what if parameters: is NOT the immediate next line but later?
            // Usually my standard formatting puts security, then parameters or requestBody.
            // If it's not the next line, we can just safely inject 'parameters:' right here.
            
            // To be totally safe, let's inject a new `parameters:` block right here.
            $inject = true;
            $j = $i+1;
            while ($j < count($lines)) {
                $checkLine = $lines[$j];
                // stop if we exit the current route scope (meaning lower indent)
                if (trim($checkLine) !== '' && substr($checkLine, 0, 6) !== '      ' && substr($checkLine, 0, 8) !== '        ') {
                    break;
                }
                if (trim($checkLine) === 'parameters:') {
                    $inject = false;
                    break;
                }
                $j++;
            }
            
            if ($inject) {
                foreach (explode("\n", "\n" . ltrim($paramBlock, "\n")) as $pLine) {
                    $newLines[] = $pLine; // add to block
                }
            } else {
                // it HAS parameters somewhere below. In this case, we'll just wait until we see it
                // Actually, let's just mark a flag and when we see `parameters:` we inject.
                $pendingInjection = true;
            }
        }
    } else if (isset($pendingInjection) && $pendingInjection && trim($line) === 'parameters:') {
        foreach (explode("\n", $refParamLine) as $refL) {
            if ($refL !== '') {
                $newLines[] = $refL;
            }
        }
        $pendingInjection = false;
    }
}

file_put_contents($file, implode("\n", $newLines));
echo "Modified openapi.yaml\n";
