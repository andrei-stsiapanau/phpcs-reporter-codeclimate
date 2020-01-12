<?php

namespace PHP_CodeSniffer\Reports;

use PHP_CodeSniffer\Files\File;
use Sniffs\Sniffs;

/**
 * Codeclimate report for PHP_CodeSniffer.
 */
class Codeclimate implements Report
{
    /**
     * {@inheritdoc}
     */
    public function generateFileReport(
        $report,
        File $phpcsFile,
        $showSources = false,
        $width = 80
    ) {
        foreach ($report['messages'] as $line => $lineErrors) {
            foreach ($lineErrors as $colErrors) {
                foreach ($colErrors as $error) {
                    if (Sniffs::isValidIssue($error)) {
                        $issue = array();
                        $issue['remediation_points'] = Sniffs::pointsFor($error);
                        $issue['type']               = 'issue';
                        $issue['categories']         = array('Styles');
                        $issue['check_name']         = $error['source'];
                        $issue['description']        =
                            str_replace(array("\n", "\r", "\t"), array('\n', '\r', '\t'), $error['message']);
                        $issue['location']['path'] = $phpcsFile->getFilename();
                        $issue['location']['lines']['begin'] = $line;
                        $issue['location']['lines']['end']   = $line;

                        echo
                            json_encode($issue, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
                            ',';
                    }
                }
            }
        }

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function generate(
        $cachedData,
        $totalFiles,
        $totalErrors,
        $totalWarnings,
        $totalFixable,
        $showSources = false,
        $width = 80,
        $interactive = false,
        $toScreen = true
    ) {
        file_put_contents(
            'php://stdout',
            sprintf('[%s]%s', rtrim($cachedData, ','), PHP_EOL)
        );
    }
}
