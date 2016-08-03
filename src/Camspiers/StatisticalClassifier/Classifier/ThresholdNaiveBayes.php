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
class ThresholdNaiveBayes extends NaiveBayes
{
    private $confidenceThreshold;

    public function __construct(
        $dataSource,
        $confidenceThreshold,
        ModelInterface $model = null,
        $documentNormalizer = null,
        TokenizerInterface $tokenizer = null,
        Token\NormalizerInterface $tokenNormalizer = null
        ) {
            $this->confidenceThreshold = $confidenceThreshold;

            parent::__construct(
                $dataSource,
                $model ,
                $documentNormalizer ,
                $tokenizer ,
                $tokenNormalizer 
            );
    }

    /**
     * @inheritdoc
     */
    public function classify( $document )
    {
        $results = $this->getClassificationProbabilities( $document );

        $category = key($results);

        $value = array_shift($results);

        if ($value === array_shift($results) || $value > $this->confidenceThreshold ) {
            return false;
        } else {
            return [ $category ];
        }
    }
}
