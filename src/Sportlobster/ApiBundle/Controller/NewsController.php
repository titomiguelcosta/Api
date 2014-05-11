<?php

namespace Sportlobster\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sportlobster\ApiBundle\Request\News\NewsCreateRequest;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\View\View as ViewResponse;
use Tmc\BadRequestBundle\Annotation\BadRequest;
use Sportlobster\ApiBundle\Request\User\UserCreateRequest;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class NewsController extends Controller
{

    /**
     * @Route("/news", name="news.create")
     * @Method({"POST"})
     * @View(statusCode=201)
     * @BadRequest("Sportlobster\ApiBundle\Type\News\NewsCreateType")
     * @ApiDoc(
     *  section="News",
     *  resource=true,
     *  description="Create a new news",
     *  statusCodes={
     *    201="News created",
     *    400="Bad request"
     *  },
     *  input="Sportlobster\ApiBundle\Type\News\NewsCreateType",
     *  output="Sportlobster\ApiBundle\Entity\News"
     * )
     */
    public function createAction(NewsCreateRequest $newsCreateRequest)
    {
        $viewResponse = ViewResponse::create();

        $newsManager = $this->get('sportlobster.api.manager.news');
        $newsEntity = $newsManager->createNews($newsCreateRequest);

        $viewResponse->setData(array('news' => $newsEntity));

        return $viewResponse;
    }

}
