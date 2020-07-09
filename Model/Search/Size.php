<?php

declare(strict_types=1);

namespace Harriswebworks\Sizing\Model\Search;

use Harriswebworks\Sizing\Model\ResourceModel\Size\CollectionFactory;
use Magento\Framework\DataObject;
use Magento\Framework\UrlInterface;

/**
 * @api
 */
class Size extends DataObject
{
    /**
     * @var UrlInterface
     */
    private $url;

    /**
     * @var CollectionFactory
     */
    private $collectionFactory;

    /**
     * @param CollectionFactory $collectionFactory
     * @param UrlInterface $adminhtmlData
     * @param array $data
     */
    public function __construct(
        CollectionFactory $collectionFactory,
        UrlInterface $url,
        array $data = []
    ) {
        $this->collectionFactory = $collectionFactory;
        $this->url = $url;
        parent::__construct($data);
    }

    /**
     * Load search results
     *
     * @return $this
     */
    public function load()
    {
        $result = [];
        if (!$this->hasStart() || !$this->hasLimit() || !$this->hasQuery()) {
            $this->setResults($result);
            return $this;
        }

        $query = $this->getQuery();
        $collection = $this->collectionFactory->create();
        $collection->addFieldToFilter('size', ['like' => '%' . $query . '%']);
        $collection->setCurPage($this->getStart());
        $collection->setPageSize($this->getLimit());
        $result[] = [
            'id' => 'size0',
            'type' => '',
            'name' => __('"%1" in Size', $query),
            'description' => '',
            'url' => $this->url->getUrl(
                'sizing/size/index',
                ['_query' => "search=" . $query]
            ),
        ];
        foreach ($collection as $item) {
            $result[] = [
                'id' => 'size' . $item->getId(),
                'type' => __('Size'),
                'name' => __('Size %1', $item->getSize()),
                'description' => __('Size %1', $item->getSize()),
                'url' => $this->url->getUrl(
                    'sizing/size/edit',
                    ['size_id' => $item->getId()]
                ),
            ];
        }
        $this->setResults($result);
        return $this;
    }
}
