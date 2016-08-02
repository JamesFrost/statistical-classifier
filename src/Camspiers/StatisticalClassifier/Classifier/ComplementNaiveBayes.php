<?php

/**
 * This file is part of the Statistical Classifier package.
 *
 * (c) Cam Spiers <camspiers@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Camspiers\StatisticalClassifier\Classifier;

/**
 * An implementation of a Naive Bayes classifier.
 *
 * This classifier is based off *Tackling the Poor Assumptions of Naive Bayes Text Classifiers* by Jason Rennie
 * @author  Cam Spiers <camspiers@gmail.com>
 * @package Statistical Classifier
 */
class ComplementNaiveBayes extends NaiveBayes
{
    /**
     * @inheritdoc
     */
    public function classify( $document )
    {
        $results = $this->getClassificationProbabilities( $document );

        $category = key($results);

        $value = array_shift($results);

        if ($value === array_shift($results)) {
            return false;
        } else {
            return [ $category ];
        }
    }
}
