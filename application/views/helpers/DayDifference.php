<?php
/**
 * Day difference helper.
 */
class Zend_View_Helper_DayDifference
{
    /**
     * Calculate the difference in days between two dates.
     *
     * @param  Zend_Date $date1
     * @param  Zend_Date $date2
     * @return integer
     */
    public function DayDifference(Zend_Date $date1, Zend_Date $date2 = null)
    {
        $date1 = new DateTime(
            $date1->get(Zend_Date::ISO_8601)
        );


        if ($date2 === null) {
            $date2 = new Zend_Date();
        }

        $date2 = new DateTime(
            $date2->get(Zend_Date::ISO_8601)
        );

        $diff = $date1->diff($date2);

        if ($diff->y > 0) {
            return ($diff->y === 1) ? $diff->y . ' year ago' : $diff->m . ' years ago';
        }

        if ($diff->m > 0) {
            return ($diff->m === 1) ? $diff->m . ' month ago' : $diff->m . ' months ago';
        }

        if ($diff->d > 0) {
            return ($diff->d === 1) ? $diff->d . ' day ago' : $diff->h . ' days ago';
        }

        if($diff->h > 0) {
            return ($diff->h === 1) ? $diff->h . ' hour ago' : $diff->h . ' hours ago';
        }

        if($diff->i > 0) {
            return ($diff->i === 1) ? $diff->i . ' minute ago' : $diff->i . ' minutes ago';
        }

        if($diff->s > 0) {
            return ($diff->s === 1) ? $diff->s . ' second ago' : $diff->s . ' seconds ago';
        }

        return 'Right now';
    }
}