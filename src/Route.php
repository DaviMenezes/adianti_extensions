<?php
namespace Dvi\AdiantiExtension;

use Adianti\Base\App\Service\SystemDocumentUploaderService;
use Adianti\Base\Lib\Base\TStandardSeek;
use Adianti\Base\Lib\Service\AdiantiMultiSearchService;
use Adianti\Base\Lib\Service\AdiantiUploaderService;
use Adianti\Base\Lib\Widget\Dialog\TMessage;
use Adianti\Base\Modules\Admin\Control\EmptyPage;
use Adianti\Base\Modules\Admin\Control\LoginForm;
use Adianti\Base\Modules\Admin\Control\SystemDatabaseExplorer;
use Adianti\Base\Modules\Admin\Control\SystemDataBrowser;
use Adianti\Base\Modules\Admin\Control\SystemGroupForm;
use Adianti\Base\Modules\Admin\Control\SystemGroupList;
use Adianti\Base\Modules\Admin\Control\SystemModulesCheckView;
use Adianti\Base\Modules\Admin\Control\SystemPageBatchUpdate;
use Adianti\Base\Modules\Admin\Control\SystemPageUpdate;
use Adianti\Base\Modules\Admin\Control\SystemPHPErrorLogView;
use Adianti\Base\Modules\Admin\Control\SystemPHPInfoView;
use Adianti\Base\Modules\Admin\Control\SystemPreferenceForm;
use Adianti\Base\Modules\Admin\Control\SystemProfileForm;
use Adianti\Base\Modules\Admin\Control\SystemProfileView;
use Adianti\Base\Modules\Admin\Control\SystemProgramForm;
use Adianti\Base\Modules\Admin\Control\SystemProgramList;
use Adianti\Base\Modules\Admin\Control\SystemRegistrationForm;
use Adianti\Base\Modules\Admin\Control\SystemSQLPanel;
use Adianti\Base\Modules\Admin\Control\SystemSupportForm;
use Adianti\Base\Modules\Admin\Control\SystemTableList;
use Adianti\Base\Modules\Admin\Control\SystemUnitForm;
use Adianti\Base\Modules\Admin\Control\SystemUnitList;
use Adianti\Base\Modules\Admin\Control\SystemUserForm;
use Adianti\Base\Modules\Admin\Control\SystemUserList;
use Adianti\Base\Modules\Available\Control\PublicView;
use Adianti\Base\Modules\Common\Control\CommonPage;
use Adianti\Base\Modules\Common\Control\MessageList;
use Adianti\Base\Modules\Common\Control\NotificationList;
use Adianti\Base\Modules\Common\Control\SearchBox;
use Adianti\Base\Modules\Common\Control\SearchInputBox;
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
use App\Config\MyRoutes;
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
        try {
            $route = MyRoutes::getRoutes();
            if (array_key_exists($class, $route)) {
                return $route[$class];
            } elseif (in_array($class, $route)) {
                return $class;
            }

            $class_name = self::getClassName($class);
            $error_msg = 'O arquivo ' . $class_name . ' não tem sua rota mapeada.<br>';
            $error_msg .= 'Adicione a linha abaixo no arquivo App\Config\MyRoutes.php <hr>';
            $error_msg .= '$routes[\''.$class_name.'\'] = '.$class_name.'::class;';

            throw new Exception($error_msg);
        } catch (Exception $e) {
            new TMessage('info', $e->getMessage());
            die();
        }
    }

    public static function getClassName($class)
    {
        foreach (MyRoutes::getRoutes() as $key => $route) {
            if ($class == $route) {
                return $key;
                break;
            }
        }
        $class_name = explode('\\', $class);
        $class_name = array_pop($class_name);
        return $class_name;
    }

    public static function getRoutes()
    {
        //Adianti Modules
        //Admin
        $routes['EmptyPage'] = EmptyPage::class;
        $routes['LoginForm'] = LoginForm::class;
        $routes['SystemDatabaseExplorer'] = SystemDatabaseExplorer::class;
        $routes['SystemDataBrowser'] = SystemDataBrowser::class;
        $routes['SystemGroupForm'] = SystemGroupForm::class;
        $routes['SystemGroupList'] = SystemGroupList::class;
        $routes['SystemPageBatchUpdate'] = SystemPageBatchUpdate::class;
        $routes['SystemPageUpdate'] = SystemPageUpdate::class;
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

        //Available
        $routes['PublicView'] = PublicView::class;
        $routes['CommonPage'] = CommonPage::class;
        $routes['MessageList'] = MessageList::class;
        $routes['NotificationList'] = NotificationList::class;
        $routes['SearchBox'] = SearchBox::class;
        $routes['SearchInputBox'] = SearchInputBox::class;
        $routes['WelcomeView'] = WelcomeView::class;

        //Communication
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

        //Log
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

        $routes['download'] = 'download.php';

        return $routes;
    }
}
