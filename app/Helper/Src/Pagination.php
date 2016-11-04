<?php
namespace App\Helper\Src;

use Illuminate\Pagination\BootstrapThreePresenter;

class Pagination extends BootstrapThreePresenter
{
    /**
     * Convert the URL window into Zurb Foundation HTML.
     *
     * @return string
     */
    public function render()
    {
        if ($this->hasPages()) {
            return sprintf(
                '<ul class="pagination">%s %s %s</ul>',
                $this->getPreviousButton(' Prev'),
                $this->getLinks(),
                $this->getNextButton('Next ')
            );
        }

        return '';
    }

    /**
     * Get HTML wrapper for an available page link.
     *
     * @param  string  $url
     * @param  int  $page
     * @param  string|null  $rel
     * @return string
     */
    protected function getAvailablePageWrapper($url, $page, $rel = null)
    {
        $type = '';
        if ($page == ' Prev') {
            $type = 'prev';
        } elseif ($page == 'Next ') {
            $type = 'next';
        }

        $rel = is_null($rel) ? '' : ' rel="'.$rel.'"';

        $request = request()->all();
        if (isset($request['request'])) $url = $url . '&request='.$request['request'];

        return '<li><a class="'.$type.'" href="'.$url.'" '.$rel.'>'.$page.'</a></li>';
    }

    /**
     * Get HTML wrapper for disabled text.
     *
     * @param  string  $text
     * @return string
     */
    protected function getDisabledTextWrapper($text)
    {
        $type = '';
        if ($text == ' Prev') {
            $type = 'prev';
        } elseif ($text == 'Next ') {
            $type = 'next';
        }

        return '<li><a class="'.$type.'" href="javascript:void(0);" disabled>'.$text.'</a></li>';
    }

    /**
     * Get HTML wrapper for active text.
     *
     * @param  string  $text
     * @return string
     */
    protected function getActivePageWrapper($text)
    {
        return '<li><a href="javascript:void(0);" class="active">'.$text.'</a></li>';
    }

    /**
     * Get a pagination "dot" element.
     *
     * @return string
     */
    protected function getDots()
    {
        return $this->getDisabledTextWrapper('...');
    }

    /**
     * Get the current page from the paginator.
     *
     * @return int
     */
    protected function currentPage()
    {
        return $this->paginator->currentPage();
    }

    /**
     * Get the last page from the paginator.
     *
     * @return int
     */
    protected function lastPage()
    {
        return $this->paginator->lastPage();
    }
}

