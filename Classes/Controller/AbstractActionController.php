<?php
declare(strict_types=1);

namespace T3v\T3vCore\Controller;

use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Mvc\View\ViewInterface;

/**
 * The abstract action controller class.
 *
 * @package T3v\T3vCore\Controller
 */
abstract class AbstractActionController extends ActionController
{
    /**
     * The content object data.
     *
     * @var array
     */
    protected array $data;

    /**
     * Initializes an action.
     *
     * @override
     */
    protected function initializeAction(): void
    {
        parent::initializeAction();

        $contentObject = $this->configurationManager->getContentObject();

        if ($contentObject !== null) {
            $this->data = $contentObject->data;
        }
    }

    /**
     * Initialises a new view.
     *
     * @param ViewInterface $view The view
     */
    protected function initializeView(ViewInterface $view): void
    {
        parent::initializeView($view);

        $this->view->assign('data', $this->data);
    }

    /**
     * Assigns the arguments from the original request.
     */
    protected function assignOriginalArguments(): void
    {
        $originalRequest = $this->request->getOriginalRequest();

        if ($originalRequest !== null) {
            $originalArguments = $originalRequest->getArguments();

            $this->view->assign('originalArguments', $originalArguments);
        }
    }
}
