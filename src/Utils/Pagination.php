<?php

namespace Mxmilyasov\Converter\Utils;

class Pagination
{

    private int $max = 10;

    private string $index;

    private int $currentPage;

    private int $total;

    private int $limit;

    private int $amount;

    public function __construct(int $total, int $currentPage, int $limit, string $index)
    {
        $this->total = $total;
        $this->limit = $limit;
        $this->index = $index;
        $this->amount = $this->amount();
        $this->setCurrentPage($currentPage);
    }

    public function get(): string
    {
        $links = null;

        $limits = $this->limits();

        $html = '<ul class="pagination justify-content-center">';

        for ($page = $limits[0]; $page <= $limits[1]; $page++) {
            if ($page == $this->currentPage) {
                $links .= '<li class="page-link active"><a href="#">' . $page . '</a></li>';
            } else {
                $links .= $this->generateHtml($page);
            }
        }

        if (!is_null($links)) {
            if ($this->currentPage > 1) {
                $links = $this->generateHtml(1, '&lt;') . $links;
            }

            if ($this->currentPage < $this->amount) {
                $links .= $this->generateHtml($this->amount, '&gt;');
            }
        }

        $html .= $links . '</ul>';

        return $html;
    }

    private function generateHtml(int $page, string $text = null): string
    {
        if (!$text) {
            $text = $page;
        }

        $currentUri = rtrim($_SERVER['REQUEST_URI'], '/') . '/';
        $currentUri = preg_replace('~/page/[0-9]+~', '', $currentUri);

        return '<li class="page-item"><a class="page-link" href="' .
            $currentUri . $this->index . $page . '">' . $text . '</a></li>';
    }

    private function limits(): array
    {
        $left = $this->currentPage - round($this->max / 2);
        $start = $left > 0 ? $left : 1;

        if ($start + $this->max <= $this->amount) {
            $end = $start > 1 ? $start + $this->max : $this->max;
        } else {
            $end = $this->amount;

            $start = $this->amount - $this->max > 0 ? $this->amount - $this->max : 1;
        }

        return [$start, $end];
    }

    private function setCurrentPage(int $currentPage): void
    {
        $this->currentPage = $currentPage;
        if ($this->currentPage > 0) {
            if ($this->currentPage > $this->amount) {
                $this->currentPage = $this->amount;
            }
        } else {
            $this->currentPage = 1;
        }
    }

    private function amount(): int
    {
        return (int)ceil($this->total / $this->limit);
    }
}
