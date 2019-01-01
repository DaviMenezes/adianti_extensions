<?php
namespace Dvi\AdiantiExtension;
//Todo remover apos testes
use Adianti\Base\App\Service\SystemDocumentUploaderService;
use Adianti\Base\Lib\Base\TStandardSeek;
use Adianti\Base\Lib\Service\AdiantiMultiSearchService;
use Adianti\Base\Lib\Service\AdiantiUploaderService;
use Adianti\Base\Lib\Widget\Dialog\TMessage;
use Adianti\Base\Modules\Admin\Control\EmptyPage;
use Adianti\Base\Modules\Admin\User\Control\LoginForm;
use Adianti\Base\Modules\Admin\Database\Control\SystemDatabaseExplorer;
use Adianti\Base\Modules\Admin\Database\Control\SystemDataBrowser;
use Adianti\Base\Modules\Admin\Program\Control\SystemGroupForm;
use Adianti\Base\Modules\Admin\Program\Control\SystemGroupList;
use Adianti\Base\Modules\Admin\Control\SystemModulesCheckView;
use Adianti\Base\Modules\Admin\Control\SystemPageBatchUpdate;
use Adianti\Base\Modules\Admin\Control\SystemPHPErrorLogView;
use Adianti\Base\Modules\Admin\Control\SystemPHPInfoView;
use Adianti\Base\Modules\Admin\Control\SystemPreferenceForm;
use Adianti\Base\Modules\Admin\User\Control\SystemProfileForm;
use Adianti\Base\Modules\Admin\User\Control\SystemProfileView;
use Adianti\Base\Modules\Admin\Program\Control\SystemProgramForm;
use Adianti\Base\Modules\Admin\Program\Control\SystemProgramList;
use Adianti\Base\Modules\Admin\User\Control\SystemRegistrationForm;
use Adianti\Base\Modules\Admin\Database\Control\SystemSQLPanel;
use Adianti\Base\Modules\Admin\Control\SystemSupportForm;
use Adianti\Base\Modules\Admin\Database\Control\SystemTableList;
use Adianti\Base\Modules\Admin\Unit\Control\SystemUnitForm;
use Adianti\Base\Modules\Admin\Unit\Control\SystemUnitList;
use Adianti\Base\Modules\Admin\User\Control\SystemUserForm;
use Adianti\Base\Modules\Admin\User\Control\SystemUserList;
use Adianti\Base\Modules\Available\Control\PublicView;
use Adianti\Base\Modules\Common\Control\CommonPage;
use Adianti\Base\Modules\Common\Control\MessageList;
use Adianti\Base\Modules\Common\Control\NotificationList;
use Adianti\Base\Modules\Common\Control\SearchBox;
use Adianti\Base\Modules\Common\Control\WelcomeView;
use Adianti\Base\Modules\Communication\Control\SystemDocumentCategoryFormList;
use Adianti\Base\Modules\Communication\Control\SystemDocumentForm;
use Adianti\Base\Modules\Communication\Control\SystemDocumentList;
use Adianti\Base\Modules\Communication\Control\SystemDocumentUploadForm;
use Adianti\Base\Modules\Communication\Control\SystemMessageForm;
use Adianti\Base\Modules\Communication\Control\SystemMessageFormView;
use Adianti\Base\Modules\Communication\Control\SystemMessageList;
use Adianti\Base\Modules\Communication\Control\SystemNotificationFormView;
use Adianti\Base\Modules\Communication\Control\SystemNotificationList;
use Adianti\Base\Modules\Communication\Control\SystemSharedDocumentList;
use Adianti\Base\Modules\Log\Control\SystemAccessLogList;
use Adianti\Base\Modules\Log\Control\SystemAccessLogStats;
use Adianti\Base\Modules\Log\Control\SystemChangeLogView;
use Adianti\Base\Modules\Log\Control\SystemSqlLogList;
use Adianti\Base\Modules\Log\Model\SystemAccessLog;
use Adianti\Base\Modules\Log\Model\SystemSqlLog;
use App\Http\RouteInfo;
use App\Http\Router;
use Dvi\Adianti\Helpers\Reflection;
use Exception;
use SystemRequestPasswordResetForm;

/**
 * Control Routes
 *
 * @version    Dvi 1.0
 * @package    DviAdianti
 * @subpackage Adianti
 * @author     Davi Menezes
 * @copyright  Copyright (c) 2017. (davimenezes.dev@gmail.com)
 * @link https://github.com/DaviMenezes
 */
class Route
{
    /**
     * @throws Exception
     */
    public static function getPath($class)
    {
        //Todo verificar se este metodo eh usado no projeto dvioffice, senao, excluir
        try {
            $handler = Router::routes()->map(function ($route_info, $route) use ($class) {
                /**@var RouteInfo $route_info*/
                if (Reflection::shortName($route_info->class()) == $class) {
                    return $route_info->class();
                }
            });
            return $handler;
        } catch (Exception $e) {
            new TMessage('info', $e->getMessage());
            die();
        }
    }

    public static function getRoutes()
    {
        //Todo verificar se este metodo eh usado no projeto dvioffice, senao, excluir
        //Adianti Modules
        //Admin
        //Todo remover apos testes
        $routes['EmptyPage'] = EmptyPage::class;
        $routes['LoginForm'] = LoginForm::class;
        $routes['SystemDatabaseExplorer'] = SystemDatabaseExplorer::class;
        $routes['SystemDataBrowser'] = SystemDataBrowser::class;
        $routes['SystemGroupForm'] = SystemGroupForm::class;
        $routes['SystemGroupList'] = SystemGroupList::class;
        $routes['SystemPageBatchUpdate'] = SystemPageBatchUpdate::class;
        $routes['SystemPHPErrorLogView'] = SystemPHPErrorLogView::class;
        $routes['SystemPHPInfoView'] = SystemPHPInfoView::class;
        $routes['SystemPreferenceForm'] = SystemPreferenceForm::class;
        $routes['SystemProfileView'] = SystemProfileView::class;
        $routes['SystemProfileForm'] = SystemProfileForm::class;
        $routes['SystemProgramForm'] = SystemProgramForm::class;
        $routes['SystemProgramList'] = SystemProgramList::class;
        $routes['SystemSQLPanel'] = SystemSQLPanel::class;
        $routes['SystemSupportForm'] = SystemSupportForm::class;
        $routes['SystemTableList'] = SystemTableList::class;
        $routes['SystemUnitForm'] =  SystemUnitForm::class;
        $routes['SystemUnitList'] = SystemUnitList::class;
        $routes['SystemUserForm'] = SystemUserForm::class;
        $routes['SystemUserList'] = SystemUserList::class;
        $routes['TStandardSeek'] = TStandardSeek::class;
        $routes['SystemRegistrationForm'] = SystemRegistrationForm::class;
        $routes['SystemRequestPasswordResetForm'] = SystemRequestPasswordResetForm::class;
//
//        //Available
        $routes['PublicView'] = PublicView::class;
        $routes['CommonPage'] = CommonPage::class;
        $routes['MessageList'] = MessageList::class;
        $routes['NotificationList'] = NotificationList::class;
        $routes['SearchBox'] = SearchBox::class;
        $routes['WelcomeView'] = WelcomeView::class;
//
//        //Communication
        $routes['SystemDocumentCategoryFormList'] = SystemDocumentCategoryFormList::class;
        $routes['SystemDocumentForm'] = SystemDocumentForm::class;
        $routes['SystemDocumentList'] = SystemDocumentList::class;
        $routes['SystemDocumentUploadForm'] = SystemDocumentUploadForm::class;
        $routes['SystemMessageForm'] = SystemMessageForm::class;
        $routes['SystemMessageFormView'] = SystemMessageFormView::class;
        $routes['SystemMessageList'] = SystemMessageList::class;
        $routes['SystemNotificationFormView'] = SystemNotificationFormView::class;
        $routes['SystemNotificationList'] = SystemNotificationList::class;
        $routes['SystemSharedDocumentList'] = SystemSharedDocumentList::class;
//
//        //Log
        $routes['SystemAccessLogList'] = SystemAccessLogList::class;
        $routes['SystemAccessLogStats'] = SystemAccessLogStats::class;
        $routes['SystemChangeLogView'] = SystemChangeLogView::class;
        $routes['SystemSqlLogList'] = SystemSqlLogList::class;

        $routes['SystemSqlLog'] = SystemSqlLog::class;
        $routes['SystemAccessLog'] = SystemAccessLog::class;
        $routes['SystemDocumentUploaderService'] = SystemDocumentUploaderService::class;
        $routes['AdiantiUploaderService'] = AdiantiUploaderService::class;
        $routes['AdiantiMultiSearchService'] = AdiantiMultiSearchService::class;
        $routes['SystemModulesCheckView'] = SystemModulesCheckView::class;
//
        $routes['download'] = 'download.php';

        return $routes;
    }
}
